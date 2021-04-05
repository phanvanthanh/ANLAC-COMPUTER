@extends('layouts.script-layout')
@section('title', 'In phiếu xuất kho(Hóa đơn)')
@section('content')
@php
	if($error!=""){
		echo '<p>'.$error.'. Bạn sẽ <b>quay lại danh sách phiếu xuất</b>  sau <b><span id="counter">5</span> giây(s).</p></b>
            <script type="text/javascript">
            function countdown() {
                var i = document.getElementById("counter");
                if (parseInt(i.innerHTML)<=0) {
                    location.href = "/phieu-xuat";
                }
            if (parseInt(i.innerHTML)!=0) {
                i.innerHTML = parseInt(i.innerHTML)-1;
            }
            }
            setInterval(function(){ countdown(); },1000);
            </script>';
            exit();
	}

	use SimpleSoftwareIO\QrCode\Facades\QrCode;
	$ngay=0; $thang=0; $nam=0; $ngayThangNam='';
    $ngayXuat = strtotime($phieuXuat['ngay_xuat']);
    $ngay = date('d',$ngayXuat);
    $thang = date('m',$ngayXuat);
    $nam = date('Y',$ngayXuat);
    $ngayThangNam = date('d/m/Y',$ngayXuat);
@endphp


<style type="text/css">
	h1 { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } 
	h2 { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } 
	h3 { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 14px; } 
	p { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; margin-bottom: -2px;}
	blockquote { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 21px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px; }
	pre { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18.5714px; }
	thead{
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;
	}
	tbody{
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; line-height: 15.4px;
	}
	table, td, th {
	  border: 0.5px solid #b3b3b3;
	}

	table {
	  width: 100%;
	  border-collapse: collapse;
	}
	.vertical-center {
	  margin: 0;
	  position: absolute;
	  top: 50%;
	  -ms-transform: translateY(-50%);
	  transform: translateY(-50%);
	}
	.container {
	  position: relative;
	}
	div{
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
	}	
</style>

<div class="row ">
	<div class="col-12">
		<div class="row">
			<div class="col-12">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-10">
				<div class="col-12">
					<h3 style="white-space: nowrap; margin-bottom: 0px;">CÔNG TY TNHH THƯƠNG MẠI VÀ DỊCH VỤ AN LẠC COMPUTER</h3>
					<p>Ấp Chợ, xã Tân Sơn, huyện Trà Cú, tỉnh Trà Vinh.</p>
				</div>
				<div class="col-12 text-center">
					<h1 style="margin-top: 20px;">PHIẾU GIAO HÀNG</h1>
				</div>
			</div>
			<div class="col-2">
				{!! QrCode::generate($phieuXuat['ma_phieu_xuat']); !!}
			</div>
				
		</div>
		
		<div class="row">
			<div class="col-8">
				<p style="margin-top: 10px;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tên khách hàng: <b>{{$khachHang['ten_khach_hang']}}</b> / <b>{{$khachHang['di_dong']}}</b><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Địa chỉ: <b>{{$khachHang['dia_chi']}}</b> <br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mã số thuế: ....................................................................................
				</p>
			</div>
			<div class="col-4">
				<div style="font-size: 13px;">Ngày: <b style="font-size: 13px;">{{$ngayThangNam}}</b></div> 
				<div style="font-size: 13px;">Số: <b style="font-size: 13px;">{{$phieuXuat['ma_phieu_xuat']}}</b></div> 
				<div style="font-size: 13px;">Loại tiền: <b style="font-size: 13px;">VNĐ</b></div> 
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table style="">
					<thead>
						<tr class="text-center">
							<th>STT</th>
							<th>Mã hàng hóa</th>
							<th>Tên hàng hóa</th>
							<th>Đơn vị tính</th>
							<th>Số lượng</th>
							<th>Đơn giá</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
						@php $stt=0; $tongThanhTien=0; $tongGiamGia=0; @endphp
						@foreach($chiTietPhieuXuats as $chiTietPhieuXuat)
							@php 
								$stt++; 
								$tongThanhTien+=$chiTietPhieuXuat['thanh_tien']; 
								$tongGiamGia+=$chiTietPhieuXuat['giam_gia'];
							@endphp
							<tr>
								<td class="text-center">
									&nbsp;{{$stt}}
								</td>
								<td class="text-center">
									&nbsp;{{$chiTietPhieuXuat['ma_san_pham']}}
								</td>
								<td>
									&nbsp;{{$chiTietPhieuXuat['ten_san_pham']}}
								</td>
								<td>
									&nbsp;{{$chiTietPhieuXuat['ten_don_vi_tinh']}}
								</td>
								<td>
									&nbsp;{{number_format($chiTietPhieuXuat['so_luong'],0)}}
								</td>
								<td>
									&nbsp;{{number_format($chiTietPhieuXuat['gia_xuat'],0)}}
								</td>
								<td style="white-space: nowrap;">
									@php
										$conLai=$chiTietPhieuXuat['thanh_tien']-$chiTietPhieuXuat['giam_gia'];
									@endphp
									&nbsp;@if($chiTietPhieuXuat['giam_gia']>0) 
										{{number_format($conLai,0)}} <a style="text-decoration-line: line-through;">{{number_format($chiTietPhieuXuat['thanh_tien'],0)}} </a>
									@else
										{{number_format($chiTietPhieuXuat['thanh_tien'],0)}} 
									@endif
								</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="6" class="text-right" style="text-align: right;"><b>Cộng tiền hàng &nbsp;</b></td>
							<td>
								@php $tongCong=$tongThanhTien-$tongGiamGia; @endphp
								&nbsp;<b>{{number_format($tongCong,0)}}</b>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								Thuế suất GTGT:
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tiền thuế GTGT:
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right" style="text-align: right;">Tổng tiền thanh toán &nbsp;</td>
							<td>&nbsp;{{number_format($phieuXuat['da_thanh_toan'],0)}}</td>
						</tr>
						<tr>
							<td colspan="7">&nbsp;<b>Tổng cộng bằng chữ: <b style="font-size:15px;">@php echo Helper::chuyenSoThanhChu($tongCong); @endphp</b></b></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<p>Ghi chú:</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-right" style="text-align: right;">
				
				<p>Ngày {{$ngay}} tháng {{$thang}} năm {{$nam}}</p> <br>
			</div>
		</div>
		<div class="row">
			<div class="col-3 text-center">
				<h3>Nhân viên kinh doanh</h3>
				<p>(Ký, ghi rõ họ tên)</p>
			</div>
			<div class="col-3 text-center">
				<h3>Kế toán trưởng</h3>
				<p>(Ký, ghi rõ họ tên)</p>
			</div>
			<div class="col-3 text-center">
				<h3>Thủ kho</h3>
				<p>(Ký, ghi rõ họ tên)</p>
			</div>
			<div class="col-3 text-center">
				<h3>Người mua hàng</h3>
				<p>(Ký, ghi rõ họ tên)</p>
			</div>
		</div>
	</div>
</div>
		
			
    
    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	  	loadPrint();
	  	function loadPrint() {
		    window.print();
		    setTimeout(function () { 
		    	location.href = "{{ url()->previous() }}";
		    }, 500);
		}
	});
	</script>
@endsection


