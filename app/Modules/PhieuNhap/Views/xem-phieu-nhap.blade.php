
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
					<h3 class="print" style="white-space: nowrap; margin-bottom: 0px;">C??NG TY TNHH TH????NG M???I V?? D???CH V??? AN L???C COMPUTER</h3>
					<p class="print">???p Ch???, x?? T??n S??n, huy???n Tr?? C??, t???nh Tr?? Vinh.</p>
				</div>
				<div class="col-12 text-center">
					<h1 class="print" style="margin-top: 20px;">H??A ????N NH???P H??NG</h1>
				</div>
			</div>
			<div class="col-2">
				{!! QrCode::generate($phieuNhap['ma_phieu_nhap']); !!}
			</div>
				
		</div>
		
		<div class="row">
			<div class="col-8">
				<p style="margin-top: 10px;" class="print">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T??n kh??ch h??ng: <b>{{$khachHang['ten_doi_tac']}}</b> / <b>{{$khachHang['di_dong']}}</b><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?????a ch???: <b>{{$khachHang['dia_chi']}}</b>
				</p>
			</div>
			<div class="col-4">
				<div class="print" style="font-size: 13px;">Ng??y: <b style="font-size: 13px;">{{$ngayThangNam}}</b></div> 
				<div class="print" style="font-size: 13px;">S???: <b style="font-size: 13px;">{{$phieuNhap['ma_phieu_nhap']}}</b></div> 
				<div class="print" style="font-size: 13px;">Lo???i ti???n: <b style="font-size: 13px;">VN??</b></div> 
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="print" style="" >
					<thead class="print">
						<tr class="text-center print">
							<th class="print">STT</th>
							<th class="print">M?? h??ng h??a</th>
							<th class="print">T??n h??ng h??a</th>
							<th class="print">????n v??? t??nh</th>
							<th class="print">S??? l?????ng</th>
							<th class="print">????n gi??</th>
							<th class="print">Th??nh ti???n</th>
							<th class="print">Ghi ch??</th>
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
							<td colspan="6" class="text-right print" style="text-align: right;">Gi???m gi?? &nbsp;</td>
							<td class="print">&nbsp;{{number_format($tongGiamGia,0)}}</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;"><b>T???ng c???ng &nbsp;</b></td>
							<td class="print">
								@php $tongCong=$tongThanhTien-$tongGiamGia; @endphp
								&nbsp;<b>{{number_format($tongCong,0)}}</b>
							</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;">N??? c?? &nbsp;</td>
							<td class="print">&nbsp;{{number_format($tongConLaiNoCu,0)}}</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;">Tr??? tr?????c &nbsp;</td>
							<td class="print">&nbsp;{{number_format($phieuNhap['da_thanh_toan'],0)}}</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6" class="text-right print" style="text-align: right;">N??? hi???n t???i &nbsp;</td>
							<td class="print">
								@php
									$noHienTai=$tongConLaiNoCu+($tongCong-$phieuNhap['da_thanh_toan']);
								@endphp
								&nbsp;{{number_format($noHienTai,0)}}
							</td>
							<td class="print">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="8" class="print">&nbsp;<b>T???ng c???ng b???ng ch???: <b style="font-size:15px;">@php echo Helper::chuyenSoThanhChu($tongCong); @endphp</b></b></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<p class="print" style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ghi ch??: {{$phieuNhap['ghi_chu']}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-right" style="text-align: right;">
				
				<p class="print">Ng??y {{$ngay}} th??ng {{$thang}} n??m {{$nam}}</p> <br>
			</div>
		</div>
		<div class="row">
			<div class="col-4 text-center">
				<h3 class="print">Ng?????i nh???n h??ng</h3>
				<p class="print">(K??, ghi r?? h??? t??n)</p>
			</div>
			<div class="col-4 text-center">
				<h3 class="print">???? nh???n ????? ti???n</h3>
				<p class="print">(K??, ghi r?? h??? t??n)</p>
			</div>
			<div class="col-4 text-center">
				<h3 class="print">Ng?????i vi???t h??a ????n</h3>
				<p class="print">(K??, ghi r?? h??? t??n)</p>
			</div>
		</div>
	</div>
</div>
		
			
    

