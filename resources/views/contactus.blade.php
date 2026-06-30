@extends('layouts.main.master')
@section('title')
Liên hệ với chúng tôi
@endsection
@section('description')
Liên hệ với chúng tôi
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
@php
    $contactPhone1 = trim((string) ($setting->phone1 ?? ''));
    $contactPhone2 = trim((string) ($setting->phone2 ?? ''));
    $contactPhone1Digits = preg_replace('/[^0-9+]/', '', $contactPhone1);
    $contactPhone2Digits = preg_replace('/[^0-9+]/', '', $contactPhone2);
    $contactEmail = trim((string) ($setting->email ?? ''));
    $contactAddressMain = trim((string) ($setting->address2 ?? ''));
    $contactAddressOffice = trim((string) ($setting->address1 ?? ''));
    $contactAddress = $contactAddressMain !== '' ? $contactAddressMain : $contactAddressOffice;
@endphp
<section class="page-title" style="background-image: url({{ url('frontend/images/hai-trinh.jpg') }});">
   <div class="auto-container">
      <div class="title-outer text-center">
         <h1 class="title">Liên hệ</h1>
         <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">Trang chủ</a></li>
            <li>Liên hệ</li>
         </ul>
      </div>
   </div>
</section>
<section class="contact-details">
   <div class="container ">
      <div class="row">
         <div class="col-xl-7 col-lg-6">
            <div class="sec-title">
               <span class="sub-title">Gửi email</span>
               <h2>Gửi thông tin liên hệ</h2>
            </div>
            <!-- Contact Form -->
            <form id="contact_form" class="" action="{{route('postcontact')}}" method="post" novalidate="novalidate">
               @csrf
               <div class="row">
                  <div class="col-sm-6">
                     <div class="mb-3">
                        <input name="name" class="form-control" type="text" placeholder="Họ và tên">
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="mb-3">
                        <input name="email" class="form-control required email" type="email" placeholder="Email">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="mb-3">
                        <input name="phone" class="form-control" type="text" placeholder="Số điện thoại">
                     </div>
                  </div>
               </div>
               <div class="mb-3">
                  <textarea name="mess" class="form-control required" rows="7" placeholder="Nội dung"></textarea>
               </div>
               <div class="mb-5">
                  <button type="submit" class="theme-btn btn-style-one mb-3 mb-sm-0"><span class="btn-title">Gửi thông tin</span></button>
               </div>
            </form>
            <!-- Contact Form Validation-->
         </div>
         <div class="col-xl-5 col-lg-6">
            <div class="contact-details__right">
               <div class="sec-title">
                  <span class="sub-title">Cần trợ giúp?</span>
                  <h2>Liên hệ với chúng tôi</h2>
                  <div class="text">Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.</div>
               </div>
         <ul class="list-unstyled contact-details__info">
           <li class="d-block d-sm-flex align-items-sm-center ">
             <div class="icon">
               <span class="far fa-phone-plus"></span>
             </div>
             <div class="text ml-xs--0 mt-xs-10">
               <h6>Hotline</h6>
               <a href="tel:{{ $contactPhone1 }}">{{ $contactPhone1 }}</a>
             </div>
           </li>
           <li class="d-block d-sm-flex align-items-sm-center ">
             <div class="icon">
               <span class="far fa-envelope"></span>
             </div>
             <div class="text ml-xs--0 mt-xs-10">
               <h6>Email</h6>
               <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
             </div>
           </li>
           <li class="d-block d-sm-flex align-items-sm-center ">
             <div class="icon">
               <span class="far fa-location-dot"></span>
             </div>
             <div class="text ml-xs--0 mt-xs-10">
               <h6>Địa chỉ</h6>
               <span>{{ $contactAddress }}</span>
             </div>
           </li>
         </ul>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="map-section">
   {!! $setting->iframe_map !!}
</section>
@endsection