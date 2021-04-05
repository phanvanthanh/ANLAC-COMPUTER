<table id="order-listing" class="table table-hover" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <!-- <th></th> -->
            <th>STT #</th>
            <th>Họ tên khách hàng</th>
            <th>Điện thoại</th>
            <th>Ngày</th>
            <th>Số phiếu nợ</th>
            
            <!-- <th>Công ty</th> -->
            
            <!-- <th>Địa chỉ</th> -->
            
            
            <th>Tổng nợ</th>
            
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($congNos as $congNo)
            <?php 
                $stt++; 
                $phieuNos=\Helper::laySoPhieuNoTheoIdKhachHang($congNo['id']);
            ?>
            <tr class="tr-hover tr-small">
                <!-- <td></td> -->
                <td class="text-center">                    
                    {{$stt}}
                </td>
                <td class="cusor" data="{{$congNo['id']}}">
                    {{$congNo['ten_khach_hang']}}
                </td>
                <td>
                    {{$congNo['di_dong']}}      
                </td>
                <td class="text-center">
                    @php
                    foreach($phieuNos as $phieuNo){
                        $ngayXuat = strtotime($phieuNo['ngay_xuat']);
                        $ngayThangNam = date('d/m/Y',$ngayXuat);
                        echo $ngayThangNam.'<br>';
                    }
                    @endphp
                </td>
                <td class="text-center">
                @php
                    
                    foreach($phieuNos as $phieuNo){
                        echo '<a target="_blank" href="'.route('in-phieu-xuat').'?id='.$phieuNo['id'].'" class="text-primary">'.$phieuNo['ma_phieu_xuat'].'</a><br>';
                    }
                @endphp
                </td>
                
                
                <!-- <td>
                    {{$congNo['ten_cong_ty']}}
                </td> -->
                
                <!-- <td>
                    {{$congNo['dia_chi']}}
                </td> -->
                
                
                <td><b>{{number_format($congNo['tong_no'],0)}}</b></td>
                
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
            getById(_token, id, "{{ route('cong-no-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });
    });
</script>


