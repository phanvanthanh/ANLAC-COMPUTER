@if($error=="")
  @php $checkData=0; @endphp
  @php if($data){$checkData=1;} @endphp
        {{ csrf_field() }}
        <input type="hidden" name="id" class="id" @if($checkData==1) value="{{$data['id']}}" @endif>
        <link rel="stylesheet" href="{{ asset('public/css/autocomplete.css') }}">

        <div class="row">
          <div class="col-sm-4">
            <!-- <div class="form-group row">
              <div class="col-12 text-center"><h4 class="text-primary">THÔNG TIN PHIẾU NHẬP KHO</h4></div>
            </div> -->
            <div class="form-group row">
              <label for="ma_phieu_xuat" class="col-sm-4 col-form-label ">Số phiếu xuất <span class="text-danger">(*)</span></label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control ma_phieu_xuat" name="ma_phieu_xuat" placeholder="Vui lòng nhập số phiếu xuất kho" @if($checkData==1 && isset($data['ma_phieu_xuat'])) value="{{$data['ma_phieu_xuat']}}" @else value="{{$maPhieuXuatMoi}}" @endif autocomplete="off" tabindex="1" focus="true">
              </div>
            </div>

            @php
                $ngayXuat2 = date('Y-m-d').'T'. date('H:i:s');
                if($checkData==1){
                    $ngayXuat = strtotime($data['ngay_xuat']);
                    $ngayXuat2 = date('Y-m-d',$ngayXuat).'T'. date('H:i:s',$ngayXuat);
                }
                @endphp

            <div class="form-group row">
              <label for="ngay_xuat" class="col-sm-4 col-form-label ">Ngày xuất <span class="text-danger"></span></label>
              <div class="col-sm-8">
                 <input type="datetime-local" class="form-control ngay_xuat" name="ngay_xuat" value="{{$ngayXuat2}}" autocomplete="off" tabindex="2" focus="true">
              </div>
            </div>


            <div class="form-group row">
              <label for="ten_khach_hang" class="col-sm-4 col-form-label ">Khách hàng <span class="text-danger">(*)</span></label>
              <div class="col-sm-8 autocomplete">
                 <input type="Text" class="form-control input-autocomplete ten_khach_hang" id="ten_khach_hang" name="ten_khach_hang" placeholder="Chọn khách hàng" autocomplete="off" tabindex="3" @if($checkData==1) value="{{$data['ten_khach_hang']}} - {{$data['ma_khach_hang']}}" @endif>
              </div>
            </div>

            <div class="form-group row">
              <label for="da_thanh_toan" class="col-sm-4 col-form-label ">Đã thanh toán</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control da_thanh_toan" name="da_thanh_toan" placeholder="Số tiền đã thanh toán" @if($checkData==1) value="{{$data['da_thanh_toan']}}" @endif tabindex="4" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
              </div>
            </div>

            <div class="form-group row">
              <label for="ghi_chu" class="col-sm-4 col-form-label ">Ghi chú</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control ghi_chu" name="ghi_chu" placeholder="Nhập ghi chú" @if($checkData==1) value="{{$data['ghi_chu']}}" @endif tabindex="5">
              </div>
            </div>


           

            

            <!-- <div class="form-group row">
              <label for="da_thanh_toan" class="col-sm-4 col-form-label ">TT thanh toán</label>
              <div class="col-sm-8">
                 <div class="icheck-square">
                    <input name="da_thanh_toan" type="checkbox" id="da_thanh_toan" value="1" @if($checkData==1) @if($data['da_thanh_toan']) {{'checked="checked"'}} @endif @endif>
                    <label for="da_thanh_toan">Check vào nếu đã thanh toán</label>
                  </div>
              </div>
            </div> -->

            



          </div>
          <div class="col-sm-4">
             <div class="form-group row">
                <label for="dia_chi" class="col-sm-4 col-form-label ">Địa chỉ <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control dia_chi" name="dia_chi" placeholder="Địa chỉ khách hàng" @if($checkData==1) value="{{$data['dia_chi']}}" @endif disabled="disabled">
                </div>
            </div>
            <div class="form-group row">
              <label for="so_dien_thoai" class="col-sm-4 col-form-label ">Số điện thoại</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control so_dien_thoai" name="so_dien_thoai" placeholder="Số điện thoại khách hàng" @if($checkData==1) value="{{$data['di_dong']}}" @endif disabled="disabled">
              </div>
            </div>


            <div class="form-group row">
              <label for="ma_san_pham" class="col-sm-4 col-form-label ">Mã sản phẩm</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control ma_san_pham" name="ma_san_pham" placeholder="Hiển thị mã sản phẩm cần bán" disabled="disabled">
              </div>
            </div>


            <div class="form-group row">
              <label for="ten_san_pham" class="col-sm-4 col-form-label ">Tên sản phẩm <span class="text-danger">(*)</span></label>
              <div class="col-sm-8 autocomplete">
                 <input type="Text" class="form-control input-autocomplete ten_san_pham" id="ten_san_pham" name="ten_san_pham" placeholder="Chọn sản phẩm cần nhập kho" autocomplete="off" tabindex="6" check-so-luong="1">
              </div>
            </div>

            <div class="form-group row">
                <label for="gia_xuat" class="col-sm-4 col-form-label ">Đơn giá xuất <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control gia_xuat" name="gia_xuat" placeholder="Vui lòng nhập giá xuất của sản phẩm" autocomplete="off" tabindex="7" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
                </div>
            </div>

            
                

            
          </div>
          <div class="col-sm-4">
            <div class="form-group row">
                <label for="gia_nhap" class="col-sm-4 col-form-label ">Giá nhập gốc</label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control gia_nhap" name="gia_nhap" autocomplete="off"  disabled="disabled" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
                </div>
            </div>
            <div class="form-group row">
                <label for="so_luong" class="col-sm-4 col-form-label ">Số lượng <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control so_luong" name="so_luong" placeholder="Vui lòng nhập số lượng của sản phẩm" autocomplete="off" tabindex="8" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
                </div>
            </div>
                

            <div class="form-group row">
                <label for="thanh_tien" class="col-sm-4 col-form-label ">Thành tiền <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control thanh_tien" name="thanh_tien" placeholder="Vui lòng nhập thành tiền của sản phẩm"  autocomplete="off" tabindex="9" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
                </div>
            </div>

            <div class=" form-group row">
              <label for="giam_gia" class="col-sm-4 col-form-label ">Giảm giá <span class="text-danger">(*)</span></label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control giam_gia" name="giam_gia" placeholder="Vui lòng nhập thành tiền của sản phẩm"  autocomplete="off" tabindex="10" value="0" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
              </div>
            </div>
            <div class=" form-group row">
              <label for="con_lai" class="col-sm-4 col-form-label "><b>Còn lại <span class="text-danger">(*)</span></b></label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control con_lai text-danger" name="con_lai"  autocomplete="off" tabindex="11" placeholder="Số tiền còn lại sau khi giảm giá" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
              </div>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="button" class="btn btn-vnpt btn-them" style="margin-bottom: 10px;"><i class="icon-check"></i> Thêm</button>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <table class="table table-hover" data-ordering="false">
              <thead>
                  <tr class="background-vnpt text-center">
                      <!-- <th></th> -->
                      <th>STT #</th>
                      <th>Mã sản phẩm</th>
                      <th>Tên sản phẩm</th>
                      <th>Đơn vị tính</th>
                      <th>Số lượng</th>
                      <th>Đơn giá</th>
                      <th>Thành tiền</th>
                      <th>Giảm giá</th>
                      <th>Còn lại</th>
                      <th>Xử lý</th>
                  </tr>
              </thead>
              <tbody class="load-chi-tiet">
              </tbody>
            </table>  
          </div>
        </div>












     <script type="text/javascript" src="{{ asset('public/js/input-currency.js') }}"></script>
     <script type="text/javascript" src="{{ asset('public/js/uploadFile.js') }}"></script>
     <script type="text/javascript" src="{{ asset('public/js/showFile.js') }}"></script> 
     <script type="text/javascript" src="{{ asset('public/js/autocomplete.js') }}"></script> 
     <script type="text/javascript">
      <?php
        $jsonKhachHangs='var khachHangs=[';
        foreach ($khachHangs as $key => $khachHang) {
          $jsonKhachHangs.="'".str_replace("'","",str_replace('"',"",$khachHang['ten_khach_hang'])).' - '.$khachHang['ma_khach_hang']."',";
        }
        $jsonKhachHangs.="];";
        echo $jsonKhachHangs;
      ?>

      <?php
        $jsonSanPham="var sanPhams=[";
        foreach ($sanPhams as $key => $sanPham) {
          $jsonSanPham.='"'.str_replace("'","",str_replace('"',"",$sanPham['ten_san_pham'])).' - '.$sanPham['ma_san_pham'].'",';
        }
        $jsonSanPham.="];";
        echo $jsonSanPham;
      ?>

      /*initiate the autocomplete function on the "my input id" element, and pass along the countries array as possible autocomplete values:*/
      autocomplete(document.getElementById("ten_khach_hang"), khachHangs);
      autocomplete(document.getElementById("ten_san_pham"), sanPhams);

      $('.table').dataTable({
         aLengthMenu: [
          [25, 50, 100, 200, -1],
          [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
      });
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();

      $('.giam_gia').on("change", function(e) {
          var conLai=jQuery('.thanh_tien').val().replace(/,/g, '')-jQuery('.giam_gia').val().replace(/,/g, '');
          jQuery('.con_lai').val(conLai);
      });
      $('.giam_gia').on("keypress", function(e) {
          /* ENTER PRESSED*/
          var conLai=jQuery('.thanh_tien').val().replace(/,/g, '')-jQuery('.giam_gia').val().replace(/,/g, '');
          jQuery('.con_lai').val(conLai);
      });
      $('.giam_gia').on("keyup", function(e) {
          /* ENTER PRESSED*/
          var conLai=jQuery('.thanh_tien').val().replace(/,/g, '')-jQuery('.giam_gia').val().replace(/,/g, '');
          jQuery('.con_lai').val(conLai);
      });


      $('.so_luong').on("change", function(e) {
          var thanhTien=jQuery(this).val().replace(/,/g, '')*jQuery('.gia_xuat').val().replace(/,/g, '');
          jQuery('.thanh_tien').val(thanhTien);
      });
      $('.so_luong').on("keypress", function(e) {
          /* ENTER PRESSED*/
          var thanhTien=jQuery(this).val().replace(/,/g, '')*jQuery('.gia_xuat').val().replace(/,/g, '');
          jQuery('.thanh_tien').val(thanhTien);
      });
      $('.so_luong').on("keyup", function(e) {
          /* ENTER PRESSED*/
          var thanhTien=jQuery(this).val().replace(/,/g, '')*jQuery('.gia_xuat').val().replace(/,/g, '');
          jQuery('.thanh_tien').val(thanhTien);
      });


      $('.gia_xuat').on("change", function(e) {
          var thanhTien=jQuery(this).val().replace(/,/g, '')*jQuery('.so_luong').val().replace(/,/g, '');
          jQuery('.thanh_tien').val(thanhTien);
      });
      $('.gia_xuat').on("keypress", function(e) {
          /* ENTER PRESSED*/
          var thanhTien=jQuery(this).val().replace(/,/g, '')*jQuery('.so_luong').val().replace(/,/g, '');
          jQuery('.thanh_tien').val(thanhTien);
      });
      $('.gia_xuat').on("keyup", function(e) {
          /* ENTER PRESSED*/
          var thanhTien=jQuery(this).val().replace(/,/g, '')*jQuery('.so_luong').val().replace(/,/g, '');
          jQuery('.thanh_tien').val(thanhTien);
      });





      $('.con_lai').on("keypress", function(e) {
          var frmId=jQuery(this).closest('form').attr('id');
          var conLai=jQuery(this).val().replace(/,/g, '');
          var thanhTien=jQuery('.thanh_tien').val().replace(/,/g, '');
          if (e.keyCode == 13) {
            if(conLai>0 && thanhTien>0){
              themChiTietPhieuXuat(_token, $("form#"+frmId), "{{ route('them-chi-tiet-phieu-xuat') }}", "{{ route('load-chi-tiet-phieu-xuat') }}", '.load-chi-tiet');
              jQuery('.ten_san_pham').val('');
              jQuery('.ten_san_pham').focus();
              return false;  
            }
                
          }
      });

      $('.btn-them').on('click', function() {
        var conLai=jQuery('.thanh_tien').val().replace(/,/g, '')-jQuery('.giam_gia').val().replace(/,/g, '');
        jQuery('.con_lai').val(conLai);
        var frmId=jQuery(this).closest('form').attr('id');
        var conLai=jQuery('.con_lai').val().replace(/,/g, '');
        var thanhTien=jQuery('.thanh_tien').val().replace(/,/g, '');
        if(conLai>0 && thanhTien>0){
          themChiTietPhieuXuat(_token, $("form#"+frmId), "{{ route('them-chi-tiet-phieu-xuat') }}", "{{ route('load-chi-tiet-phieu-xuat') }}", '.load-chi-tiet');
          jQuery('.ten_san_pham').val('');
          jQuery('.ten_san_pham').focus();
          return false;  
        }
      });


      $('.ngay_xuat').on("keypress", function(e) {
          /* ENTER PRESSED*/
          if (e.keyCode == 13) {
              /* FOCUS ELEMENT */
              jQuery('.ten_khach_hang').focus();
          }
      });

      $('.ghi_chu').on('click',function(){
        jQuery('.ten_san_pham').focus();
      });

      $('input').on("keypress", function(e) {
          /* ENTER PRESSED*/
          if (e.keyCode == 13) {
              /* FOCUS ELEMENT */
              var value=jQuery(this).val();
              if(value || jQuery(this).hasClass('ghi_chu')){
                var nextTabIndex = $(this).attr('tabindex');
                nextTabIndex++;
                jQuery('input').each(function(){
                  if(jQuery(this).attr('tabindex')==nextTabIndex){
                    jQuery(this).focus();
                  }
                });
              }
                
              return false;
          }
      });
      setTimeout(function() {
        jQuery('.ma_phieu_xuat').focus();
      }, 1000);

      var idPhieuXuat=jQuery('.id').val();
      if(idPhieuXuat){
        jQuery("#modal-cap-nhat").modal('hide');
        jQuery('.btn-xoa-phieu-xuat').attr("data",idPhieuXuat);
        getById(_token, idPhieuXuat, "{{ route('load-chi-tiet-phieu-xuat') }}", '.load-chi-tiet');

      }
            
  </script>

@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif


