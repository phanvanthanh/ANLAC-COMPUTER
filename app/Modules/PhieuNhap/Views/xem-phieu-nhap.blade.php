
@php
	if($error!=""){
		exit();
	}

	use SimpleSoftwareIO\QrCode\Facades\QrCode;
	$ngay=0; $thang=0; $nam=0; $ngayThangNam='';
    $ngayNhap = strtotime($phieuNhap['ngay_nhap']);
    $ngay = date('d',$ngayNhap);
    $thang = date('m',$ngayNhap);
    $nam = date('Y',$ngayNhap);
    $ngayThangNam = date('d/m/Y',$ngayNhap);
@endphp


<style type="text/css">
	h1.print { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } 
	h2.print { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } 
	h3.print { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 14px; } 
	p.print { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; margin-bottom: -2px;}
	blockquote.print { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 21px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px; }
	pre.print { font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18.5714px; }
	thead.print{
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;
	}
	tbody.print{
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; line-height: 15.4px;
	}
	table.print, td.print, th.print {
	  border: 0.5px solid #b3b3b3;
	}

	table.print {
	  width: 100%;
	  border-collapse: collapse;
	}
	.vertical-center.print {
	  margin: 0;
	  position: absolute;
	  top: 50%;
	  -ms-transform: translateY(-50%);
	  transform: translateY(-50%);
	}
	.container.print {
	  position: relative;
	}
	div.print{
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
	}	
</style>

<div class="row">
	<div class="col-12">
		<div class="row">
			<div class="col-12">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-10">
				<div class="col-12">
					<h3 class="print" style="white-space: nowrap; margin-bottom: 0px;">CÔNG TY TNHH THƯƠNG MẠI VÀ DỊCH VỤ AN LẠC COMPUTER</h3>
					<p class="print">Ấp Chợ, xã Tân Sơn, huyện Trà Cú, tỉnh Trà Vinh.</p>
				</div>
				<div class="col-12 text-center">
					<h1 class="print" style="margin-top: 20px;">HÓA ĐƠN NHẬP HÀNG</h1>
				</div>
			</div>
			<div class="col-2">
				{!! QrCode::generate($phieuNhap['ma_phieu_nhap']); !!}
			</div>
				
		</div>
		
		<div class="row">
			<div class="col-8">
				<p style="margin-top: 10px;" class="print">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tên khách hàng: <b>{{$khachHang['ten_doi_tac']}}</b> / <b>{{$khachHang['di_dong']}}</b><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Địa chỉ: <b>{{$khachHang['dia_chi']}}</b>
				</p>
			</div>
			<div class="col-4">
				<div class="print" style="font-size: 13px;">Ngày: <b style="font-size: 13px;">{{$ngayThangNam}}</b></div> 
				<div class="print" style="font-size: 13px;">Số: <b style="font-size: 13px;">{{$phieuNhap['ma_phieu_nhap']}}</b></div> 
				<div class="print" style="font-size: 13px;">Loại tiền: <b style="font-size: 13px;">VNĐ</b></div> 
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="print" style="" >
					<thead class="print">
						<tr class="text-center print">
							<th class="print">STT</th>
							<th class="print">Mã hàng hóa</th>
							<th class="print">Tên hàng hóa</th>
							<th class="print">Đơn vị tính</th>
							<th class="print">Số lượng</th>
							<th class="print">Đơn giá</th>
							<th class="print">Thành tiền</th>
							<th class="print">Ghi chú</th>
						</tr>
					</thead>
					<tbody class="print">
						@php $stt=0; $tongThanhTien=0; $tongGiamGia=0; @endphp
						@foreach($chiTietPhieuNhaps as $chiTietPhieuNhap)
							@php 
								$stt++; 
								$tongThanhTien+=$chiTietPhieuNhap['thanh_tien']; 
								$tongGiamGia+=$chiTietPhieuNhap['giam_gia'];
							@endphp
							<tr>
								<td class="text-center print">
									&nbsp;{{$stt}}
								</td>
								<td class="text-center print">
									&nbsp;{{$chiTietPhieuNhap['ma_san_pham']}}
								</td>
								<td class="print">
									&nbsp;{{$chiTietPhieuNhap['ten_san_pham']}}
								</td>
								<td class="print">
									&nbsp;{{$chiTietPhieuNhap['ten_don_vi_tinh']}}
								</td>
								<td class="print">
									&nbsp;{{number_format($chiTietPhieuNhap['so_luong'],0)}}
								</td>
								<td class="print">
									&nbsp;{{number_format($chiTietPhieuNhap['gia_nhap'],0)}}
								</td>
								<td class="print" style="white-space: nowrap;">
									@php
										$conLai=$chiTietPhieuNhap['thanh_tien']-$chiTietPhieuNhap['giam_gia'];
									@endphp
									&nbsp;
									@if($chiTietPhieuNhap['giam_gia']>0) 
										{{number_format($conLai,0)}} <a style="text-decoration-line: line-through;">{{number_format($chiTietPhieuNhap['thanh_tien'],0)}} </a>
									@else
										{{number_format($chiTietPhieuNhap['thanh_tien'],0)}} 
									@endif
								</td>
								<td class="print">
									&nbsp;{{$chiTietPhieuNhap['ghi_chu']}}
								</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;">Giảm giá &nbsp;</td>
							<td class="print">&nbsp;{{number_format($tongGiamGia,0)}}</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;"><b>Tổng cộng &nbsp;</b></td>
							<td class="print">
								@php $tongCong=$tongThanhTien-$tongGiamGia; @endphp
								&nbsp;<b>{{number_format($tongCong,0)}}</b>
							</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;">Nợ cũ &nbsp;</td>
							<td class="print">&nbsp;{{number_format($tongConLaiNoCu,0)}}</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;">Trả trước &nbsp;</td>
							<td class="print">&nbsp;{{number_format($phieuNhap['da_thanh_toan'],0)}}</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;">Nợ hiện tại &nbsp;</td>
							<td class="print">
								@php
									$noHienTai=$tongConLaiNoCu+($tongCong-$phieuNhap['da_thanh_toan']);
								@endphp
								&nbsp;{{number_format($noHienTai,0)}}
							</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="8" class="print">&nbsp;<b>Tổng cộng bằng chữ: <b style="font-size:15px;">@php echo Helper::chuyenSoThanhChu($tongCong); @endphp</b></b></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<p class="print" style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ghi chú: {{$phieuNhap['ghi_chu']}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-right" style="text-align: right;">
				
				<p class="print">Ngày {{$ngay}} tháng {{$thang}} năm {{$nam}}</p> <br>
			</div>
		</div>
		<div class="row">
			<div class="col-4 text-center">
				<h3 class="print">Người nhận hàng</h3>
				<p class="print">(Ký, ghi rõ họ tên)</p>
			</div>
			<div class="col-4 text-center">
				<h3 class="print">Đã nhận đủ tiền</h3>
				<p class="print">(Ký, ghi rõ họ tên)</p>
			</div>
			<div class="col-4 text-center">
				<h3 class="print">Người viết hóa đơn</h3>
				<p class="print">(Ký, ghi rõ họ tên)</p>
			</div>
		</div>
	</div>
</div>
		
			
    

