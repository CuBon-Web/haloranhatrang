<header class="main-header header-style-one outer-box-position">
   <!-- Header Top -->
   <div class="header-top">
       <div class="inner-container">
           <div class="top-left">
            <ul class="social-icon-one">
               <li><a href="tel:{{$setting->phone1}}"><span class="fal fa-phone"></span></a></li>
               <li><a href="{{$setting->facebook}}"><span class="fab fa-facebook-f"></span></a></li>
               <li><a href="{{$setting->tiktok}}">Zalo</a></li>
           </ul>
           </div>
           <div class="top-right">
               <!-- Info List -->
               <ul class="list-style-one">
                   <li><i class="fa fa-map-marker-alt"></i> {{$setting->address1}} </li>
                   <li><i class="fa fa-envelope"></i> <a
                           href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                   </li>
               </ul>
           </div>
       </div>
   </div>
   <!-- Header Top -->
   <div class="header-lower">
       <!-- Main box -->
       <div class="main-box">
           <div class="logo-box">
               <div class="logo"><a href="{{route('home')}}"><img width="150"
                           src="{{$setting->logo}}"
                           alt="Logo" title="{{$setting->webname}}"></a></div>
           </div>
           <!--Nav Box-->
           <div class="nav-outer">
               <nav class="nav main-menu">
                   <ul class="navigation">
                       <li class="current dropdown">
                           <a href="/">Trang chủ</a>
                       </li>
                       <li class="dropdown">
                           <a href="javascript:void(0)">Dịch vụ</a>
                           <ul>
                              @foreach ($servicehome as $item)
                              <li><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                              @endforeach
                           </ul>
                       </li>
                       <li class="dropdown">
                           <a href="{{route('haitrinh')}}">Hải trình</a>
                           <ul>
                            @foreach ($haitrinh as $item)
                            <li><a href="{{route('haitrinhDetail',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                            @endforeach
                           </ul>
                       </li>
                       <li><a href="{{route('aboutUs')}}">Câu chuyện thương hiệu</a></li>
                       <li><a href="{{route('duanTieuBieu')}}">Ưu đãi</a></li>
                       <li class="dropdown">
                           <a href="javascript:void(0)">Tin tức & sự kiện</a>
                           <ul>
                              @foreach ($blogCate as $item)
                              <li><a href="{{route('listCateBlog',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                              @endforeach
                           </ul>
                       </li>
                       <li><a href="{{route('lienHe')}}">Liên hệ</a></li>
                   </ul>
               </nav>
               <div class="mobile-nav-toggler"> <span class="icon fa-sharp far fa-bars"></span> </div>
           </div>
           <!-- Outer Box -->
           <div class="outer-box">
               <div class="divider"></div>
               <!-- Btn Box -->
               <div class="btn-box me-2 call-btn header-hotline">
                   <a href="tel:{{ $setting->phone1 }}" class="header-hotline__link"
                       aria-label="Gọi hotline {{ $setting->phone1 }}">
                       <span class="header-hotline__icon" aria-hidden="true">
                           <i class="icon fal fa-phone"></i>
                       </span>
                       <span class="header-hotline__text">
                           <span class="header-hotline__label">Hotline</span>
                           <strong class="header-hotline__number">{{ $setting->phone1 }}</strong>
                       </span>
                   </a>
               </div>
               <!-- Button -->
               <div class="btn-box">
                   <button type="button" class="theme-btn btn-style-three hover-dark"
                       data-bs-toggle="modal" data-bs-target="#bookNowModal" aria-label="Book Now">
                       <span class="btn-title">Book Now</span>
                   </button>
               </div>
               <!-- Mobile Nav toggler -->
               <div class="mobile-nav-toggler"><span class="icon fa-sharp far fa-bars"></span></div>
           </div>
       </div>
   </div>
   <!-- Mobile Menu  -->
   <div class="mobile-menu">
       <div class="menu-backdrop"></div>
       <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
       <nav class="menu-box">
           <div class="upper-box">
               <div class="nav-logo"><a href="{{route('home')}}"><img
                           src="{{$setting->logo_footer}}"
                           alt="" title=""></a></div>
               <div class="close-btn"><i class="icon fa fa-times"></i></div>
           </div>
           <ul class="navigation clearfix">
               <!--Keep This Empty / Menu will come through Javascript-->
           </ul>
           <ul class="contact-list-one">
               <li>
                   <i class="fa fa-phone"></i> 
                   <div class="text">
                        <span class="title">Hotline</span>
                        <a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                    </div>
               </li>
               <li>
                   <i class="fa fa-envelope"></i> 
                   <div class="text">
                    <span class="title">Email</span>
                    <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                </div>
               </li>
               <li>
                   <i class="fa fa-map-marker-alt"></i> 
                   <div class="text">
                    <span class="title">Địa chỉ</span>
                    <div class="text">{{$setting->address1}}</div>
                </div>
               </li>
           </ul>
       </nav>
   </div>
   <!-- End Mobile Menu -->
   <!-- Header Search -->
   <div class="search-popup">
       <span class="search-back-drop"></span>
       <button class="close-search"><span class="fa fa-times"></span></button>
       <div class="search-inner">
           <form method="get" action="{{route('search_result')}}">
            @csrf
               <div class="form-group">
                   <input type="search" name="keyword" value="" placeholder="Search..."
                       required="">
                   <button type="submit"><i class="fa fa-search"></i></button>
               </div>
           </form>
       </div>
   </div>
   <!-- End Header Search -->
   <!-- Sticky Header  -->
   <div class="sticky-header">
       <div class="auto-container">
           <div class="inner-container">
               <!--Logo-->
               <div class="logo"> <a href="{{route('home')}}" title="{{$setting->webname}}"><img
                           src="{{$setting->logo}}"
                           alt="{{$setting->webname}}" title="{{$setting->webname}}"></a> </div>
               <!--Right Col-->
               <div class="nav-outer">
                   <!-- Main Menu -->
                   <nav class="main-menu">
                       <div class="navbar-collapse show collapse clearfix">
                           <ul class="navigation clearfix">
                               <!--Keep This Empty / Menu will come through Javascript-->
                           </ul>
                       </div>
                   </nav>
                   <!-- Main Menu End-->
                   <!--Mobile Navigation Toggler-->
                   <div class="mobile-nav-toggler"><span class="icon fa-sharp far fa-bars"></span></div>
               </div>
           </div>
       </div>
   </div>
   <!-- End Sticky Menu -->
</header>