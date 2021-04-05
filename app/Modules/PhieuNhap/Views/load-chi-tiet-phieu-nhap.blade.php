<?php 
    $stt=0;
?>
@foreach($chiTietPhieuNhaps as $ct)
    <?php $stt++; ?>
    <tr class="tr-hover tr-small t-tree cusor">
        <td class="text-center">                    
            {{$stt}}
        </td>
        <td class="text-center">
            {{$ct['ma_san_pham']}}
        </td>
        <td>
            {{$ct['ten_san_pham']}}
        </td>
        <td>
            {{$ct['ten_don_vi_tinh']}}
        </td>
        <td>
            {{number_format($ct['so_luong'],0)}}      
        </td>
        <td>
            {{number_format($ct['gia_nhap'],0)}}
        </td>
        <td>
            <b>{{number_format($ct['thanh_tien'],0)}}</b>
        </td>
        <td class="text-center">
            <p class="mb-0 font-weight-normal text-danger btn-xoa" data="{{$ct['id']}}"><b><i class="fa fa-times-circle-o"></i></b>
        </td>
    </tr>
@endforeach  
<script type="text/javascript">
    jQuery('.btn-xoa').on('click',function(){      
        var id=jQuery(this).attr("data"); // lấy id
        var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
        if (result) {
            xoaChiTietPhieuNhap(_token, id, "{{ route('xoa-chi-tiet-phieu-nhap') }}", "{{ route('load-chi-tiet-phieu-nhap') }}", '.load-chi-tiet');  
        }
    });
</script>

