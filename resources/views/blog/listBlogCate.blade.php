@extends('layouts.main.master')
@section('title')
{{$title_page}} 
@endsection
@section('description')
{{$title_page}} 
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('schema')
@php
    $cleanText = function ($value) {
        $text = (string) $value;
        // Remove zero-width chars that usually appear from copy/paste.
        return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $text);
    };
    $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
    $currentUrl = url()->current();
    $homeUrl = route('home');
    $siteUrl = url('/');
    $categoryUrl = route('listCateBlog', ['slug' => $cate_name]);
    $pageTitle = $cleanText($title_page);
    $siteName = $cleanText($setting->webname ?? $setting->company ?? $title_page);
    $publisherName = $cleanText($setting->company ?? $siteName);
    $publisherLogo = !empty($setting->logo)
        ? url($setting->logo)
        : (!empty($banner[0]->image) ? url($banner[0]->image) : null);

    $itemListElements = [];
    foreach ($blog as $index => $item) {
        $postUrl = route('detailBlog', ['slug' => $item->slug]);
        $postImage = !empty($item->image) ? url($item->image) : null;
        $itemListElements[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'url' => $postUrl,
            'item' => array_filter([
                '@type' => 'BlogPosting',
                'headline' => $cleanText(languageName($item->title)),
                'description' => $cleanText(strip_tags(languageName($item->description))),
                'datePublished' => optional($item->created_at)->toIso8601String(),
                'image' => $postImage,
                'mainEntityOfPage' => $postUrl,
            ], function ($value) {
                return !is_null($value) && $value !== '';
            }),
        ];
    }

    $schemaGraph = [
        [
            '@type' => 'WebSite',
            '@id' => $siteUrl . '#website',
            'url' => $siteUrl,
            'name' => $siteName,
            'inLanguage' => 'vi-VN',
        ],
        array_filter([
            '@type' => 'Organization',
            '@id' => $siteUrl . '#organization',
            'name' => $publisherName,
            'url' => $siteUrl,
            'logo' => $publisherLogo ? [
                '@type' => 'ImageObject',
                'url' => $publisherLogo,
            ] : null,
        ], function ($value) {
            return !is_null($value) && $value !== '';
        }),
        [
            '@type' => 'BreadcrumbList',
            '@id' => $currentUrl . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Trang chủ',
                    'item' => $homeUrl,
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $pageTitle,
                    'item' => $categoryUrl,
                ],
            ],
        ],
        [
            '@type' => 'CollectionPage',
            '@id' => $currentUrl . '#collection',
            'url' => $currentUrl,
            'name' => $pageTitle,
            'description' => $pageTitle,
            'inLanguage' => 'vi-VN',
            'isPartOf' => [
                '@type' => 'WebSite',
                '@id' => $siteUrl . '#website',
            ],
        ],
        [
            '@type' => 'ItemList',
            '@id' => $currentUrl . '#itemlist',
            'name' => $pageTitle,
            'numberOfItems' => count($itemListElements),
            'itemListElement' => $itemListElements,
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@graph' => $schemaGraph], $jsonFlags) !!}</script>
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section class="page-title" style="background-image: url({{ url($image ?? 'frontend/images/hai-trinh.jpg') }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title wow fadeInUp" data-wow-delay="700ms">{{$title_page}}</h1>
            <ul class="page-breadcrumb wow fadeInUp mt-3" data-wow-delay="900ms">
                <li><a href="">Tin tức cập nhật</a></li>
                <li>{{ $title_page }}</li>
            </ul>
        </div>
    </div>
</section>
<section class="blog-section">
    <div class="icon-plane-4 bounce-y"></div>
    <div class="auto-container">
      <div class="row"> 
        @foreach ($blog as $index => $item)
        <div class="blog-block col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{$index}}00ms">
            <div class="inner-box">
              <div class="image-box">
                <figure class="image">
                  <a href="{{route('detailBlog',['slug'=>$item->slug])}}">
                    <img src="{{url(''.$item->image)}}" alt="{{languageName($item->title)}}">
                    <img src="{{url(''.$item->image)}}" alt="{{languageName($item->title)}}">
                  </a>
                </figure>
                <span class="date"> <strong>{{date_format($item->created_at,'d')}} <span>{{date_format($item->created_at,'M')}}</span> </strong> </span>
              </div>
              <div class="content-box">
                <ul class="post-meta">
                  <li><i class="fal fa-user"></i>Admin</li>
                </ul>
                <h4 class="title"><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h4>
                <a class="read-more" href="{{route('detailBlog',['slug'=>$item->slug])}}">Xem chi tiết</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

@endsection