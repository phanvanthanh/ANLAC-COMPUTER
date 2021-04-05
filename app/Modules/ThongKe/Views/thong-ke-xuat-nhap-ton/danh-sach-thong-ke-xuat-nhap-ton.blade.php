<table id="order-listing" class="table table-hover" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <!-- <th></th> -->
            <th>STT #</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Đơn vị tính</th>
            <th>Số lượng nhập</th>
            <th>Số lượng xuất</th>
            <th>Số lượng tồn</th>
            <th>Giá vốn</th>
            <th>Doanh thu</th>
            <th>Lãi lỗ</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($sanPhams as $sanPham)

            @php 
                $stt++; 
                $thongKeChung=\Helper::thongKeChungTheoIdSanPham($sanPham['id']);
            @endphp
            <tr class="tr-hover tr-small">
                <!-- <td></td> -->
                <td class="text-center">                    
                    {{$stt}}
                </td>
                <td class="text-center">
                    {{$sanPham['ma_san_pham']}}
                </td>
                <td class="text-primary">
                    {{$sanPham['ten_san_pham']}}
                </td>
                <td class="text-center">
                    {{$sanPham['ten_don_vi_tinh']}}      
                </td>
                <td>
                    {{number_format($thongKeChung['so_luong_nhap'],0)}}
                </td>                
                <td>
                    {{number_format($thongKeChung['so_luong_xuat'],0)}}
                </td>
                <td>
                    {{number_format($thongKeChung['so_luong_ton'],0)}}
                </td>
                <td class="text-danger">
                    <!-- Vốn xuất -->
                    {{number_format($thongKeChung['von_xuat'],0)}}
                </td>
                <td class="text-right text-success">
                    @php $thanhTienXuat=$thongKeChung['thanh_tien_xuat']; @endphp
                    
                    @if($thongKeChung['giam_gia_xuat']>0) 
                        @php $thanhTienXuat=$thanhTienXuat-$thongKeChung['giam_gia_xuat']; @endphp
                    @endif
                    {{number_format($thanhTienXuat,0)}} 
                </td>
                <td class="text-right text-primary">
                    @php $doanhThu=$thongKeChung['thanh_tien_xuat']-($thongKeChung['von_xuat']+$thongKeChung['giam_gia_xuat']); @endphp
                    <b>{{number_format($doanhThu,0)}}</b>
                </td>

            </tr>
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">CẬP NHẬT SẢN PHẨM</h5>
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
        
    });
</script>


