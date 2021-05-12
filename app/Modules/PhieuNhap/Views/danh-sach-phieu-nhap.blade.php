<table id="order-listing" class="table table-hover" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <th width="5%">STT #</th>
            <th width="10%">Ngày nhập</th>
            <th width="7%">Mã phiếu nhập</th>
            
            <th width="15%">Tên đối tác</th>
            <th width="5%">Điện thoại</th>
            <th width="15%">Địa chỉ</th>
            <th width="23%">Sản phẩm</th>
            <th width="10%">Ghi chú</th>
            <th width="7%">Tổng tiền</th>
            <th width="3%">Xử lý</th>
        </tr>
    </thead>
    <tbody>                       
                     
        @php $stt=0; @endphp
        @foreach($phieuNhaps as $phieuNhaps2)
            @php $tongCong=0; @endphp
            @foreach ($phieuNhaps2 as $phieuNhap)
                @php 
                    $stt++; 
                    $tongCong+=$phieuNhap['thanh_tien'];
                @endphp
                <tr class="tr-hover tr-small">
                    <!-- <td></td> -->
                    <td class="text-center">                    
                        {{$stt}}
                    </td>
                    <td class="text-center">
                        {{$phieuNhap['ngay_nhap']}}
                    </td>
                    <td class="text-center text-primary btn-xem cusor" data="{{$phieuNhap['id']}}">
                        {{$phieuNhap['ma_phieu_nhap']}}
                    </td>
                    
                    <td>
                        {{$phieuNhap['ten_doi_tac']}}
                    </td>
                    <td>
                        {{$phieuNhap['di_dong']}}
                    </td>
                    <td>
                        {{$phieuNhap['dia_chi']}}
                    </td>
                    <td class="text-primary">
                    @php
                        $sanPhams=\Helper::layThongTinSanPhamTheoIdPhieuNhap($phieuNhap['id']);
                        foreach($sanPhams as $sanPham){
                            echo $sanPham['ten_san_pham'].'<br>';
                        }
                    @endphp
                    </td>
                    <td>
                        {{$phieuNhap['ghi_chu']}}
                    </td>
                    <td class="text-right">
                        <b>{{number_format($phieuNhap['thanh_tien'],0)}}</b>
                    </td>
                    
                    <td class="text-center">
                        <button class="btn btn-vnpt" href="#" data-toggle="dropdown">
                            <i class="icon-list"></i>                          
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <a class="dropdown-item preview-item btn-sua"  data="{{$phieuNhap['id']}}">
                                    <p class="mb-0 font-weight-normal float-left text-primary btn-sua" data="{{$phieuNhap['id']}}"><b><i class="icon-wrench"></i> Sửa</b>
                                    </p>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item btn-xoa" data="{{$phieuNhap['id']}}">
                                    <p class="mb-0 font-weight-normal float-left text-danger btn-xoa" data="{{$phieuNhap['id']}}"><b><i class="icon-basket "></i> Xóa</b>
                                    </p>
                                </a>                                 
                            </div>
                        </button>
                    </td>
                </tr>

            @endforeach
            <tr class="tr-default">
                <td></td>
                <td><b>Tổng cộng</b></td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td class="text-right">
                        <b>{{number_format($tongCong,0)}}</b>
                    </td>
                <td></td>
            </tr>
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">CẬP NHẬT PHIẾU NHẬP KHO</h5>
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
              <button type="button" class="btn btn-vnpt btn-cap-nhat" data=""><i class="icon-check"></i> Cập nhật phiếu nhập</button>
              <button type="button" class="btn btn-danger btn-xoa-phieu-nhap" data=""><i class="icon-check"></i> Xóa phiếu nhập</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
           </div>
        </div>
     </div>
</div>

<div class="modal fade" id="modal-xem-phieu-nhap" tabindex="-1" role="dialog" aria-labelledby="modal-xem-phieu-nhap" aria-hidden="true"> <!-- style="margin-top: -85px; height: auto;" -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">XEM PHIẾU NHẬP KHO</h5>
              {{ csrf_field() }}
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body card" style="padding: 0px;">
                <form class="forms-sample frm-xem-phieu-nhap" id="frm-xem-phieu-nhap" name="frm-xem-phieu-nhap">
                    {{ csrf_field() }}
                </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal"><i class="icon-check"></i> Đóng</button>
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
            console.log(id);
            getById(_token, id, "{{ route('phieu-nhap-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-phieu-nhap') }}", "{{ route('danh-sach-phieu-nhap') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });


        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-phieu-nhap') }}", "{{ route('danh-sach-phieu-nhap') }}", '.load-danh-sach');  
            }
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa-phieu-nhap').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-phieu-nhap') }}", "{{ route('danh-sach-phieu-nhap') }}", '.load-danh-sach');  
                location.reload();
            }
        });

        $('#modal-cap-nhat').on('hide.bs.modal', function () {
            location.reload();
        });

        /*Sự kiện bấm vào dòng cần sửa*/
        jQuery('.btn-xem').on('click',function(){            
            var id=jQuery(this).attr("data"); // lấy id
            getById(_token, id, "{{ route('xem-phieu-nhap') }}", ".frm-xem-phieu-nhap"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-xem-phieu-nhap').modal('show'); // bật form sửa     
        });
        
    });
</script>


