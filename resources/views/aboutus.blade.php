@extends('layouts.main.master')
@section('title')
    Về Chúng Tôi
@endsection
@section('description')
    {{ $setting->company }}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section class="page-title" style="background-image: url({{ url('frontend/images/hai-trinh.jpg') }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title wow fadeInUp" data-wow-delay="700ms">Về Chúng Tôi</h1>
            <ul class="page-breadcrumb wow fadeInUp" data-wow-delay="900ms">
                <li>Về Chúng Tôi</li>
            </ul>
        </div>
    </div>
</section>
<section class="blog-details itinerary-detail-section">
    <div class="container">
        <div class="row itinerary-detail-layout">
            <div class="col-xl-12 col-lg-7">
              

                <div class="wrapper mb-40">
                    {!!($gioithieu->content)!!}
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
