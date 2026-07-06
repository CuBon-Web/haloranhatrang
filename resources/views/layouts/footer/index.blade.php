<footer class="main-footer footer-style-one">
   <div class="icon-big-boat-3 bounce-x"></div>
   <div class="icon-pattern1"></div>
   <div class="icon-pattern2"></div>
   <div class="icon-wheel-3"></div>
   <!-- Widgets Section -->
   <div class="widgets-section">
       <div class="auto-container">
           <div class="row">
               <!-- Footer Column -->
               <div class="footer-column col-xl-4 col-sm-6">
                   <div class="footer-widget about-widget">
                       <h5 class="widget-title">Halora Nha Trang Cruise</h5>
                       <div class="text">Du thuyền HALORA — Thành viên hệ sinh thái Halora Holdings từ Tập đoàn Nam Phát. Biểu tượng du thuyền dịch vụ cao cấp mới tại Nha Trang</div>
                   </div>
               </div>
               <!-- Footer Column -->
               <div class="footer-column footer-column-style-two col-xl-4 col-sm-6">
                   <div class="footer-widget links-widget">
                       <h5 class="widget-title">Liên hệ</h5>
                       <div class="widget-content">
                           <ul class="user-links">
                               <li><i class="icon fal fa-phone"></i> <a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                               </li>
                               <li><i class="icon fal fa-envelope-open"></i> <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                               </li>
                               <li><i class="icon fal fa-map-marker-alt"></i> <a href="#">{{$setting->address1}}</a>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
               <!-- Footer COlumn -->
               <div class="footer-column col-xl-4 col-sm-6">
                   <div class="footer-widget links-widget">
                       <h5 class="widget-title widget-title-style-two">Dịch vụ</h5>
                       <div class="widget-content">
                           <ul class="user-links">
                                 @foreach ($servicehome as $item)
                                 <li><i class="icon fa fa-chevron-double-right"></i> <a href="{{route('serviceList',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                                 @endforeach
                           </ul>
                       </div>
                   </div>
               </div>
               <!-- Footer COlumn -->
               {{-- <div class="footer-column col-xl-3 col-sm-6">
                   <div class="footer-widget newsletter-widget">
                       <h5 class="widget-title widget-title-style-two">Vị trí</h5>
                       <div class="text">{!!$setting->iframe_map!!}</div>
                       <!-- Newsletter Form -->
                       
                   </div>
               </div> --}}
           </div>
       </div>
   </div>
   <!--  Footer Bottom -->
   <div class="footer-bottom">
       <div class="auto-container">
           <div class="inner-container">
               <div class="copyright-text">© Copyrights reserved by Halora Nha Trang Cruise</div>
              
           </div>
       </div>
   </div>
</footer>