<?php
use Illuminate\Support\Facades\Auth;
$userId=Auth::id();
?>
         <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row"><!-- thêm các class sau để đổi màu navbar-primary navbar-success navbar-warning navbar-danger navbar-pink navbar-info navbar-dark  -->
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
               <a class="navbar-brand brand-logo" href="/">PM QUẢN LÝ DOANH THU</a>
               <a class="navbar-brand brand-logo-mini" href="/">PM QUẢN LÝ DOANH THU</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
               <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
               <span class="icon-menu"></span>
               </button>
               <ul class="navbar-nav">
               </ul>
               <ul class="navbar-nav navbar-nav-right">

                  <li class="nav-item dropdown d-none d-lg-flex">
                     <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                     <i class="flag-icon flag-icon-vn"></i>
                     Việt Nam
                     </a>
                  </li>
                  
                  <li class="nav-item dropdown">
                     <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                     <i class="icon-bell mx-0"></i>
                     <span class="count"></span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <a class="dropdown-item background-vnpt">
                           <p class="mb-0 font-weight-normal float-left">Danh sách thông báo
                           </p>
                           <span class="badge badge-pill badge-danger float-right">1</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                 <i class="icon-envelope mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Hệ thống thông báo</h6>
                              <p class="font-weight-light small-text">
                                 Phiên bản được cập nhật vào lúc <br>15:00:00 28/03/2021
                              </p>
                           </div>
                        </a>
                        <!-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-danger">
                                 <i class="icon-speech mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Hệ thống thông báo</h6>
                              <p class="font-weight-light small-text">
                                 Bình luận từ Phan Văn Thanh <br>18/07/2020 15:00:00
                              </p>
                           </div>
                        </a> -->
                        
                     </div>
                  </li>
                  
                  <li class="nav-item dropdown">
                     <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                     <i class="fa fa-user-circle-o"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                        <div class="dropdown-item background-vnpt">
                           <p class="mb-0 font-weight-normal float-left">Cấu hình thông tin tài khoản
                           </p>
                           <span class="badge badge-info badge-pill float-right"></span>
                        </div>
                        @if(!$userId)
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                 <i class="icon-user-following mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content dang-nhap">
                              <h6 class="preview-subject font-weight-medium">Đăng nhập/Đăng ký</h6>
                           </div>
                        </a>
                        @else
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-info">
                                 <i class="icon-info mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Thông tin cá nhân</h6>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-danger">
                                 <i class="icon-key mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Thay đổi mật khẩu</h6>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-danger">
                                 <i class="icon-lock-open mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">                              
                              <h6 class="preview-subject font-weight-medium">Đăng xuất</h6>  
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                              </form>
                           </div>
                        </a>
                        @endif
                     </div>
                  </li>
                  <li class="nav-item nav-settings d-none d-lg-block">
                     <a class="nav-link" href="#">
                     <i class="icon-grid"></i>
                     </a>
                  </li>
               </ul>
               <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
               <span class="icon-menu"></span>
               </button>
            </div>
         </nav>