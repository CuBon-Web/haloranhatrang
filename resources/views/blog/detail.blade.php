@extends('layouts.main.master')
@section('title')
    {{ $blog_detail->seo_title ? $blog_detail->seo_title : languageName($blog_detail->title) }}
@endsection
@section('description')
    {{ $blog_detail->meta_description ? $blog_detail->meta_description : languageName($blog_detail->description) }}
@endsection
@section('image')
    {{ url('' . $blog_detail->image) }}
@endsection
@section('schema')
    @php
        $cleanText = function ($value) {
            $text = (string) $value;
            // Remove zero-width chars that usually appear from copy/paste.
            return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $text);
        };
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
        $postTitle = $cleanText(languageName($blog_detail->title));
        $postDescription = $cleanText(
            $blog_detail->meta_description ?: strip_tags(languageName($blog_detail->description))
        );
        $postContentText = trim($cleanText(strip_tags(languageName($blog_detail->content))));
        preg_match_all('/[\p{L}\p{N}]+/u', $postContentText, $wordMatches);
        $postWordCount = count($wordMatches[0]);
        $postUrl = url()->current();
        $homeUrl = route('home');
        $categoryUrl = route('listCateBlog', ['slug' => $blog_detail->category]);
        $siteName = $setting->webname ?? ($setting->company ?? 'Website');
        $publisherName = $setting->company ?? $siteName;
        $publisherLogo = !empty($setting->logo) ? url($setting->logo) : url('' . $blog_detail->image);
    @endphp
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": {!! json_encode(url('/') . '#website', $jsonFlags) !!},
      "url": {!! json_encode(url('/'), $jsonFlags) !!},
      "name": {!! json_encode($siteName, $jsonFlags) !!}
    },
    {
      "@type": "Organization",
      "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!},
      "name": {!! json_encode($publisherName, $jsonFlags) !!},
      "url": {!! json_encode(url('/'), $jsonFlags) !!},
      "logo": {
        "@type": "ImageObject",
        "url": {!! json_encode($publisherLogo, $jsonFlags) !!}
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": {!! json_encode($postUrl . '#breadcrumb', $jsonFlags) !!},
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Trang chủ",
          "item": {!! json_encode($homeUrl, $jsonFlags) !!}
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},
          "item": {!! json_encode($categoryUrl, $jsonFlags) !!}
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": {!! json_encode($postTitle, $jsonFlags) !!},
          "item": {!! json_encode($postUrl, $jsonFlags) !!}
        }
      ]
    },
    {
      "@type": "BlogPosting",
      "@id": {!! json_encode($postUrl . '#article', $jsonFlags) !!},
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": {!! json_encode($postUrl, $jsonFlags) !!}
      },
      "headline": {!! json_encode($postTitle, $jsonFlags) !!},
      "description": {!! json_encode($postDescription, $jsonFlags) !!},
      "articleSection": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},
      "keywords": {!! json_encode(implode(', ', $blogTags ?? []), $jsonFlags) !!},
      "inLanguage": "vi-VN",
      "wordCount": {{ $postWordCount }},
      "datePublished": {!! json_encode(optional($blog_detail->created_at)->toIso8601String(), $jsonFlags) !!},
      "dateModified": {!! json_encode(optional($blog_detail->updated_at)->toIso8601String(), $jsonFlags) !!},
      "image": [
        {
          "@type": "ImageObject",
          "url": {!! json_encode(url(''.$blog_detail->image), $jsonFlags) !!}
        }
      ],
      "author": {
        "@type": "Person",
        "name": {!! json_encode($cleanText($blog_detail->author ?: 'Admin'), $jsonFlags) !!}
      },
      "publisher": {
        "@type": "Organization",
        "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!}
      }
    }
  ]
}
</script>
@endsection
@section('body_class')
blog-detail-page
@endsection
@section('css')
<style>
/* page-wrapper overflow:hidden trong theme chặn position:sticky */
body.blog-detail-page .page-wrapper {
    overflow: visible;
}

body.blog-detail-page .blog-details.itinerary-detail-section,
body.blog-detail-page .itinerary-detail-section .container {
    overflow: visible;
}

@media (min-width: 992px) {
    .blog-detail-sidebar-col {
        position: relative;
    }

    .blog-detail-sidebar-sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
        z-index: 2;
    }
}

@media (max-width: 991.98px) {
    .blog-detail-sidebar-col {
        margin-top: 40px;
    }
}
</style>
@endsection
@section('js')

@endsection
@section('content')
<section class="page-title" style="background-image: url({{ url(''.$blog_detail->image ?? 'frontend/images/hai-trinh.jpg') }});">
  <div class="auto-container">
      <div class="title-outer">
          <h1 class="title wow fadeInUp" data-wow-delay="700ms" style="font-size: 25px;">{{ languageName($blog_detail->title) }}</h1>
          <ul class="page-breadcrumb wow fadeInUp mt-3" data-wow-delay="900ms">
              <li><a href="{{ route('listCateBlog', ['slug' => $blog_detail->category]) }}">{{ languageName($blog_detail->category) }}</a></li>
              <li>{{ languageName($blog_detail->title) }}</li>
          </ul>
      </div>
  </div>
</section>

<section class="blog-details itinerary-detail-section">
  <div class="container">
      <div class="row itinerary-detail-layout">
          <div class="col-xl-8 col-lg-7">
         

              @if(!empty(languageName($blog_detail->content)))
              <div class="wrapper mb-40">
                  {!! languageName($blog_detail->content) !!}
              </div>
              @endif
          </div>

          <div class="col-xl-4 col-lg-5 blog-detail-sidebar-col itinerary-detail-sidebar-col">
            <div class="sidebar blog-detail-sidebar-sticky">
              <div class="sidebar__single sidebar__post">
                <h3 class="sidebar__title">Bài viết mới</h3>
                <ul class="sidebar__post-list list-unstyled">
                  @foreach ($blognew as $item)
                  <li>
                    <div class="sidebar__post-image"> <img src="{{url(''.$item->image)}}" alt=""> </div>
                    <div class="sidebar__post-content">
                      <h3> <a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a>
                      </h3>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="sidebar__single sidebar__category">
                <h3 class="sidebar__title">Dịch vụ</h3>
                <ul class="sidebar__category-list list-unstyled">
                  @foreach ($servicehome as $item)
                  <li><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{languageName($item->name)}}<span class="icon-right-arrow"></span></a> </li>
                  @endforeach
                </ul>
              </div>
              <div class="sidebar__single sidebar__category">
                <h3 class="sidebar__title">Hải trình</h3>
                <ul class="sidebar__category-list list-unstyled">
                  @foreach ($haitrinh as $item)
                  <li><a href="{{route('haitrinhDetail',['slug'=>$item->slug])}}">{{languageName($item->name)}}<span class="icon-right-arrow"></span></a> </li>
                  @endforeach
                </ul>
              </div>
              <br>
              @include('partials.service-register-form', [
                'itineraries' => $haitrinh,
                'useLanguageName' => true,
                'cardClass' => 'mb-30',
            ])
            </div>
          </div>
      </div>
  </div>
</section>
<section class="blog-section">
  <div class="icon-plane-4 bounce-y"></div>
  <div class="auto-container">
      <div class="sec-title text-center">
          <h2 class="words-slide-up text-split">Bài viết gợi ý</h2>
      </div>
      <div class="row">
        @foreach ($bloglq as $item)
             <!-- News Block -->
          <div class="blog-block col-lg-4 col-md-6 wow fadeInUp">
            <div class="inner-box">
                <div class="image-box">
                    <figure class="image">
                        <a href="{{route('detailBlog',['slug'=>$item->slug])}}">
                            <img src="{{url(''.$item->image)}}" alt="{{languageName($item->title)}}">
                            <img src="{{url(''.$item->image)}}" alt="{{languageName($item->title)}}">
                        </a>
                    </figure>
                    <span class="date"> <strong>{{date_format($item->created_at,'d')}} <span>{{date_format($item->created_at,'m')}} </span> </strong> </span>
                </div>
                <div class="content-box">
                    <ul class="post-meta">
                        <li><i class="fal fa-user"></i>Admin</li>
                    </ul>
                    <h4 class="title"><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h4>
                    <a class="read-more" href="{{route('detailBlog',['slug'=>$item->slug])}}">Xem thêm</a>
                </div>
            </div>
        </div>
        @endforeach
         
      </div>
  </div>
</section>
@endsection
