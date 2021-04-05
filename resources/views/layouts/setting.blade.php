@php
   $menu='dark';
   $slider='default';
   $data=\Helper::layMauBackgroundTheoUserId(1);
   if($data){
      $menu=$data['menu'];
      $slider=$data['slider'];
   }

@endphp
               <!-- partial:../../partials/_settings-panel.html -->
               <div class="theme-setting-wrapper">
                  <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
                  <div id="theme-settings" class="settings-panel">
                     <i class="settings-close mdi mdi-close"></i>
                     <p class="settings-heading">MÀU THANH SLIDEBAR</p>
                     
                     <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-vnpt border mr-3"></div>
                        VNPT
                     </div>
                     <div class="sidebar-bg-options " id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>
                        Light
                     </div>
                     <p class="settings-heading mt-2">MÀU THANH MENU</p>
                     <div class="color-tiles mx-0 px-4">
                        <div class="tiles primary"></div>
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles pink"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                     </div>
                  </div>
               </div>
               <!-- <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
               <script type="text/javascript">
                  jQuery(document).ready(function(){      
                     
                     setTimeout(function () { 
                        jQuery('.tiles').each(function( index ) {                          
                          if(jQuery(this).hasClass('{{$slider}}')){
                           jQuery(this).addClass('selected');
                           console.log("selected");
                          }
                        });
                        console.log('clicked');
                      }, 5000);
                  });
               </script> -->