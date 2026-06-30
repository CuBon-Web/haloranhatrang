<?php

namespace App\Providers;

use App\models\blog\BlogCategory;
use App\models\language\Language;
use App\models\product\Category;
use App\models\product\Product;
use App\models\ServiceCate;
use App\models\website\Banner;
use App\models\website\Itinerary;
use App\models\website\Setting;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    public function boot()
    {
        if (config('app.env') === 'production' && strpos((string) config('app.url'), 'https://') === 0) {
            \URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {
            $view->with($this->sharedLayoutData());
        });

        view()->composer(
            ['product.list', 'menu', 'baogia'],
            function ($view) {
                $view->with([
                    'categoryhome' => $this->loadCategoryHome(),
                ]);
            }
        );
    }

    private function sharedLayoutData(): array
    {
        $profile = Auth::guard('customer')->user() ?: '';

        return [
            'setting' => Setting::first(),
            'lang' => Language::get(),
            'banner' => Banner::where(['status' => 1])->get([
                'id',
                'image',
                'type',
                'video_url',
                'link',
                'title',
                'description',
            ]),
            'profile' => $profile,
            'cartcontent' => session()->get('cart', []),
            'servicehome' => ServiceCate::where('status', 1)->get(),
            'blogCate' => BlogCategory::with([
                'typeCate' => function ($query) {
                    $query->select('id', 'slug', 'name', 'avatar', 'category_slug');
                },
            ])
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->get(['id', 'name', 'slug', 'avatar'])
                ->map(function ($category) {
                    $category->setRelation('listBlog', $category->listBlog->take(6));

                    return $category;
                }),
            'haitrinh' => Itinerary::where('status', 1)
                ->orderBy('sort')
                ->orderBy('id')
                ->get(),
        ];
    }

    private function loadCategoryHome()
    {
        $categories = Category::with([
            'tagCate' => function ($query) {
                $query->with(['tags'])->where('status', 1)->orderBy('id', 'DESC');
            },
            'typeCate' => function ($query) {
                $query->with(['typetwo'])->where('status', 1)->orderBy('id', 'ASC')->select('cate_id', 'id', 'name', 'avatar', 'slug', 'cate_slug');
            },
        ])->where('status', 1)->orderBy('sort', 'ASC')->orderBy('id', 'ASC')->get(['id', 'name', 'imagehome', 'avatar', 'slug', 'content']);

        $productHomeColumns = [
            'id',
            'category',
            'name',
            'discount',
            'price',
            'images',
            'slug',
            'cate_slug',
            'type_slug',
            'status_variant',
            'discountStatus',
            'home_status',
        ];
        $typeProducts = collect();

        foreach ($categories as $category) {
            $category->setRelation(
                'product',
                Product::query()
                    ->select($productHomeColumns)
                    ->where('category', $category->id)
                    ->where('status', 1)
                    ->where('home_status', 1)
                    ->with(['cate:id,slug,name'])
                    ->orderBy('id', 'DESC')
                    ->take(10)
                    ->get()
            );

            foreach ($category->typeCate as $type) {
                $productsByType = Product::query()
                    ->select($productHomeColumns)
                    ->where('category', $category->id)
                    ->where('type_slug', $type->slug)
                    ->where('status', 1)
                    ->where('home_status', 1)
                    ->with(['cate:id,slug,name'])
                    ->orderBy('id', 'DESC')
                    ->take(8)
                    ->get();
                $type->setRelation('product', $productsByType);
                $typeProducts = $typeProducts->merge($productsByType);
            }
        }

        $products = $categories->pluck('product')->flatten()->merge($typeProducts);
        $this->attachVariantPriceRange($products);

        return $categories;
    }

    private function attachVariantPriceRange($products): void
    {
        $products = collect($products);
        if ($products->isEmpty()) {
            return;
        }

        $variantProductIds = $products
            ->where('status_variant', 1)
            ->pluck('id')
            ->filter()
            ->values()
            ->all();

        if (empty($variantProductIds)) {
            return;
        }

        $ranges = \App\models\VariantSkuValue::query()
            ->selectRaw('product_id, MIN(price) as min_price, MAX(price) as max_price')
            ->whereIn('product_id', $variantProductIds)
            ->groupBy('product_id')
            ->get()
            ->keyBy('product_id');

        foreach ($products as $product) {
            $range = $ranges->get($product->id);
            $product->variant_min_price = $range ? (float) $range->min_price : null;
            $product->variant_max_price = $range ? (float) $range->max_price : null;
        }
    }
}
