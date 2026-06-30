@extends('layouts.main.master')
@section('title')
{{$detail->name}}
@endsection
@section('description')
{{$detail->description}}
@endsection
@section('image')
{{ url(firstBeforeAfterImage($detail->images ?? '') ?: 'frontend/img/page-header-bg.png') }}
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
<section class="page-title" style="background-image: url({{ url(json_decode($detail->images, true)[0]) }});">
  <div class="auto-container">
      <div class="title-outer">
          <h1 class="title wow fadeInUp" data-wow-delay="700ms">{{ $detail->name }}</h1>
          <ul class="page-breadcrumb wow fadeInUp mt-3" data-wow-delay="900ms">
              <li><a href="">Ưu đãi</a></li>
              <li>{{$detail->name}}</li>
          </ul>
      </div>
  </div>
</section>

<section class="blog-details itinerary-detail-section">
  <div class="container">
      <div class="row itinerary-detail-layout">
          <div class="col-xl-8 col-lg-7">
         

              @if(!empty(languageName($detail->content)))
              <div class="wrapper mb-40">
                  {!! languageName($detail->content) !!}
              </div>
              @endif
          </div>

          <div class="col-xl-4 col-lg-5 blog-detail-sidebar-col itinerary-detail-sidebar-col">
            <div class="sidebar blog-detail-sidebar-sticky">
              @include('partials.service-register-form', [
                'itineraries' => $haitrinh,
                'useLanguageName' => true,
                'cardClass' => 'mb-30',
            ])
              <div class="sidebar__single sidebar__post">
                <h3 class="sidebar__title">Ưu đãi khác</h3>
                <ul class="sidebar__post-list list-unstyled">
                  @foreach ($duanlq as $item)
                  <li>
                    <div class="sidebar__post-image"> <img src="{{url(json_decode($item->images, true)[0])}}" alt=""> </div>
                    <div class="sidebar__post-content">
                      <h3> <a href="{{route('duanTieuBieuDetail',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a>
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
              
            </div>
          </div>
      </div>
  </div>
</section>


@endsection