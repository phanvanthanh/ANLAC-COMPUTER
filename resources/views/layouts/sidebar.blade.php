<?php
   use App\AdminResource;
   use App\AdminRule;
   $resources=array();
   $userId=Auth::id();
   if($userId){
      $roleId=Auth::user()->role_id;
      $resources = AdminRule::select('admin_resource.id', 'admin_resource.ten_hien_thi', 'admin_resource.parent_id', 'admin_resource.icon', 'admin_resource.uri')
         ->leftJoin('admin_resource','admin_rule.resource_id','=','admin_resource.id')
         ->where('admin_resource.status','=',1)
         ->where('admin_resource.id','!=',1)
         ->where('admin_resource.show_menu','=',1)
         ->where('admin_rule.role_id','=',$roleId)
         ->orderBy('admin_resource.order')
         ->get()->toArray();
      $resources=\Helper::paycTreeResourceHasChild($resources, 1);
   }
      
?>              
               <div id="right-sidebar" class="settings-panel">
                  <i class="settings-close mdi mdi-close"></i>
                  <ul class="nav nav-tabs" id="setting-panel" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">THÔNG BÁO HỆ THỐNG</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="setting-content">
                     <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                        <div class="list-wrapper px-3">
                           
                        </div>
                     </div>
                     <!-- To do section tab ends -->
                  </div>
               </div>
               <!-- partial -->
               <!-- partial:../../partials/_sidebar.html -->
               <nav class="sidebar sidebar-offcanvas" id="sidebar">
                  <ul class="nav">
                     <li class="nav-item nav-profile">
                        <div class="nav-link">
                           <div class="profile-image">
                              <a href="{{route('home')}}"><img src="{{ asset('public/images/logo.jpg') }}" alt="image"></a>
                           </div>
                           <div class="profile-name">
                              <p class="name">
                                 <b><h3> AN LẠC COMPUTER </h3></b>
                              </p>
                              <!-- <p class="designation">
                                 chế độ ẩn danh
                              </p> -->
                           </div>
                        </div>
                     </li>

                     @foreach($resources as $resource)
                        @if($resource['has_child']==0 && $resource['level']==0)
                        <li class="nav-item">
                           <a class="nav-link" href="{{$resource['uri']}}">
                              <?php echo $resource['icon']; ?>
                              <span class="menu-title">{{$resource['ten_hien_thi']}}</span>
                           </a>
                        </li>
                        @else
                           @if($resource['has_child']>0 && $resource['level']==0)
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="collapse" href="#icons{{$resource['id']}}" aria-expanded="false" aria-controls="icons{{$resource['id']}}">
                              <?php echo $resource['icon']; ?>&nbsp;
                              <span class="menu-title">{{$resource['ten_hien_thi']}}</span>
                              <span class="badge badge-primary">{{$resource['has_child']}}</span>
                              </a>
                              <div class="collapse" id="icons{{$resource['id']}}">
                                 <ul class="nav flex-column sub-menu">
                                    <!-- Chạy lại dòng forearch để lấy ra những phần tử con -->
                                    @foreach($resources as $resourceChild)
                                       @if($resourceChild['parent_id']==$resource['id'])
                                       <li class="nav-item"> <a class="nav-link" href="{{$resourceChild['uri']}}"><?php echo $resource['icon']; ?>&nbsp;{{$resourceChild['ten_hien_thi']}}
                                       </a></li>
                                       @endif
                                    @endforeach                                 
                                 </ul>
                              </div>
                           </li>
                           @endif
                        @endif
                     @endforeach                     
                  </ul>
               </nav>