<table id="order-listing" class="table table-hover" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <!-- <th></th> -->
            <th>STT #</th>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Công ty</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Xử lý</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($khachHangs as $khachHang)
            <?php $stt++; ?>
            <tr class="tr-hover tr-small">
                <!-- <td></td> -->
                <td class="text-center">                    
                    {{$stt}}
                </td>
                <td class="text-center">
                    @php
                        $files=explode(";",$khachHang['hinh_anh']);
                        foreach($files as $file){
                            if($file){
                            @endphp
                                <img src="{{ asset('storage/app/public/file/payc/'.$file) }}" width="34px" height="40px">
                            @php
                            }
                        }
                    @endphp
                </td>
                <td class="text-primary btn-sua cusor" data="{{$khachHang['id']}}">
                    {{$khachHang['ten_khach_hang']}}
                </td>
                <td>
                    {{$khachHang['ten_cong_ty']}}
                </td>
                <td>
                    {{$khachHang['di_dong']}}      
                </td>
                <td>
                    {{$khachHang['dia_chi']}}
                </td>
                <td class="text-center">
                    <button class="btn btn-vnpt" href="#" data-toggle="dropdown">
                        <i class="icon-list"></i>                          
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-primary btn-sua" data="{{$khachHang['id']}}"><b><i class="icon-wrench"></i> Sửa</b>
                                </p>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-danger btn-xoa" data="{{$khachHang['id']}}"><b><i class="icon-basket "></i> Xóa</b>
                                </p>
                            </a>                                 
                        </div>
                    </button>
                </td>
            </tr>
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">CẬP NHẬT THÔNG TIN ĐỐI TÁC</h5>
              {{ csrf_field() }}
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body card">
                <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
                    {{ csrf_field() }}
                </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-vnpt btn-cap-nhat"><i class="icon-check"></i> Cập nhật</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
           </div>
        </div>
     </div>
</div>


<script type="text/javascript" src="{{ asset('public/js/t-tree.js') }}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('.table').dataTable({
            
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });


        var _token=jQuery('#modal-cap-nhat').find("input[name='_token']").val();
        var table = jQuery('#order-listing').DataTable({
            lengthChange: true
        });


        /*Sự kiện bấm vào dòng cần sửa*/
        jQuery('.btn-sua').on('click',function(){            
            var id=jQuery(this).attr("data"); // lấy id
            getById(_token, id, "{{ route('khach-hang-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-khach-hang') }}", "{{ route('danh-sach-khach-hang') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-khach-hang') }}", "{{ route('danh-sach-khach-hang') }}", '.load-danh-sach');  
            }
        });
        
    });

    var lastScrollTop = 0;
      $(window).scroll(function(event){
         var st = $(this).scrollTop();
         console.log(st);
         if (st > lastScrollTop && st>250){
             // downscroll code
             var height=jQuery('#order-listing thead tr').attr('height');
              jQuery('#order-listing thead tr').css({
                  'position': 'fixed',
                  'margin-top': '-270px',
                  'z-index': '100000'
              });
         } else {
              if(st<250){
                  // upscroll code
                  jQuery('#order-listing thead tr').css({
                      'position': 'relative',
                      'margin-top': '0px',
                      'z-index': '100000'
                  });
              }
                
         }
         lastScrollTop = st;
      });
</script>


