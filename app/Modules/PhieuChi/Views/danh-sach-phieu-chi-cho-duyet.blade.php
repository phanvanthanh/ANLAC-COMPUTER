<table id="order-listing" class="table table-hover" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <!-- <th></th> -->
            <th>STT #</th>
            <th>Mã phiếu chi</th>
            <th>Nội dung</th>
            <th>Người chi</th>
            <th>Ghi chú</th>
            <th>Đã duyệt chi</th>
            <th>Tổng chi</th>
            <th>Ngày chi</th>
            <th>Xử lý</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($phieuChis as $phieuChi)
            <?php $stt++; ?>
            <tr class="tr-hover tr-small">
                <!-- <td></td> -->
                <td class="text-center">                    
                    {{$stt}}
                </td>
                <td class="btn-sua cusor text-primary" data="{{$phieuChi['id']}}">
                    {{$phieuChi['ma_phieu_chi']}}
                </td>
                
                <td class="btn-sua cusor" data="{{$phieuChi['id']}}">
                    {{$phieuChi['noi_dung']}}      
                </td>
                <td>
                    {{$phieuChi['name']}}
                </td>
                <td>
                    {{$phieuChi['ghi_chu']}}
                </td>
                <td>
                        @if($phieuChi['da_duyet']==1)
                            <div class="text-primary">{{'Đã duyệt'}}</div>
                        @else
                            <div class="text-danger">{{'Chưa duyệt'}}</div>
                        @endif
                </td>
                <td>
                    <b>{{number_format($phieuChi['tong_chi'],0)}}</b>
                </td>
                <td class="text-center">
                @php
                    $ngayChi = strtotime($phieuChi['ngay_chi']);
                    $ngayThangNam = date('d/m/Y',$ngayChi);
                @endphp
                    {{$ngayThangNam}}
                </td>
                <td class="text-center">
                    @if($phieuChi['da_duyet']==1)
                        <button type="button" class="btn btn-danger btn-duyet" data="{{$phieuChi['id']}}"><i class="fa fa-check"></i> Hủy duyệt</button>
                    @else
                        <button type="button" class="btn btn-vnpt btn-duyet" data="{{$phieuChi['id']}}"><i class="fa fa-check"></i> Duyệt</button>
                    @endif
                    
                </td>
            </tr>
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">CẬP NHẬT THÔNG TIN PHIẾU CHI</h5>
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
            getById(_token, id, "{{ route('phieu-chi-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-phieu-chi') }}", "{{ route('danh-sach-phieu-chi') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-phieu-chi') }}", "{{ route('danh-sach-phieu-chi') }}", '.load-danh-sach');  
            }
        });

        /*Sự kiện bấm vào dòng cần sửa*/
        jQuery('.btn-duyet').on('click',function(){            
            var id=jQuery(this).attr("data"); // lấy id
            getById(_token, id, "{{ route('duyet-phieu-chi') }}", ""); // gọi sự kiện lấy dữ liệu theo id
            location.reload();
        });
        
    });
</script>


