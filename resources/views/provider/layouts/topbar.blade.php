 <div class="top-bar top-minimize">
     <div class="nav-toggle minimize">
         <ul>
             <li></li>
             <li></li>
             <li></li>
         </ul>
     </div>
     <!--  -->
     <div class="logo">
         <a href="">
             <img src="{{ asset('site') }}/images/logo.png" alt="logo" />
         </a>
     </div>
     <!--  -->

     <div class="nav-toggle-dots minimize">
         <ul>
             <li></li>
             <li></li>
             <li></li>
         </ul>
     </div>
     <!--  -->
 </div>

 <div class="top-bar main-bar">
     <div class="search-page">
         <form action="">
             <input type="text" placeholder=" ابحث فالداش بورد " class="form-control" />
         </form>
     </div>

     <div class="top-content">
         <ul>
             <li>
                 <a href="" class="main_btn"> اضافة منتج </a>
             </li>
             <li>
                 <a href=""> en </a>
             </li>
             <li>
                 <a href="" class="notification">
                     <img src="{{ asset('site') }}/images/mingcute_notification-line.svg" alt="" />
                 </a>
             </li>

             <li class="avatar">
                 <a href="{{ route('site.provider.profile.index') }}">
                     <img src="{{ $store && $store->image ? asset('storage/' . $store->image) : asset('site/images/stores2.png') }}"
                         alt="صورة البروفايل" />
                 </a>
             </li>

         </ul>
     </div>
 </div>
