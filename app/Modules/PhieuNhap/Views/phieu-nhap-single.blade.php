@if($error=="")
  @php $checkData=0; @endphp
  @php if($data){$checkData=1;} @endphp
        {{ csrf_field() }}
        <input type="hidden" name="id" class="id" @if($checkData==1) value="{{$data['id']}}" @endif>
        <link rel="stylesheet" href="{{ asset('public/css/autocomplete.css') }}">

        <div class="row">
          <div class="col-sm-6">
            <!-- <div class="form-group row">
              <div class="col-12 text-center"><h4 class="text-primary">THÔNG TIN PHIẾU NHẬP KHO</h4></div>
            </div> -->
            <div class="form-group row">
              <label for="ma_phieu_nhap" class="col-sm-4 col-form-label ">Số phiếu nhập <span class="text-danger">(*)</span></label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control ma_phieu_nhap" name="ma_phieu_nhap" placeholder="Vui lòng nhập số phiếu nhập kho" @if($checkData==1 && isset($data['ma_phieu_nhap'])) value="{{$data['ma_phieu_nhap']}}" @else value="{{$maPhieuNhap}}" @endif autocomplete="off" tabindex="1" focus="true">
              </div>
            </div>

            @php
                $ngayNhap2 = date('Y-m-d').'T'. date('H:i:s');
                if($checkData==1){
                    $ngayNhap = strtotime($data['ngay_nhap']);
                    $ngayNhap2 = date('Y-m-d',$ngayNhap).'T'. date('H:i:s',$ngayNhap);
                }
                @endphp

            <div class="form-group row">
              <label for="ngay_nhap" class="col-sm-4 col-form-label ">Ngày nhập <span class="text-danger"></span></label>
              <div class="col-sm-8">
                 <input type="datetime-local" class="form-control ngay_nhap" name="ngay_nhap" placeholder="Vui lòng nhập số phiếu nhập kho" value="{{$ngayNhap2}}" autocomplete="off" tabindex="2" focus="true">
              </div>
            </div>


            <div class="form-group row">
              <label for="ten_doi_tac" class="col-sm-4 col-form-label ">Nhập từ <span class="text-danger">(*)</span></label>
              <div class="col-sm-8 autocomplete">
                 <input type="Text" class="form-control input-autocomplete ten_doi_tac" id="ten_doi_tac" name="ten_doi_tac" placeholder="Chọn nhà cung cấp" autocomplete="off" tabindex="3" @if($checkData==1) value="{{$data['ten_doi_tac']}} - {{$data['ma_doi_tac']}}" @endif>
              </div>
            </div>

            <div class="form-group row">
              <label for="da_thanh_toan" class="col-sm-4 col-form-label ">Đã thanh toán</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control da_thanh_toan" name="da_thanh_toan" placeholder="Số tiền đã thanh toán" @if($checkData==1) value="{{$data['da_thanh_toan']}}" @endif tabindex="4" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
              </div>
            </div>

            {{-- <div class="form-group row">
              <label for="ghi_chu" class="col-sm-4 col-form-label ">Ghi chú</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control ghi_chu" name="ghi_chu" placeholder="Nhập ghi chú" @if($checkData==1) value="{{$data['ghi_chu']}}" @endif tabindex="5">
              </div>
            </div> --}}


            <div class="form-group row">
                <label for="dia_chi" class="col-sm-4 col-form-label ">Địa chỉ</label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control dia_chi" name="dia_chi" placeholder="Địa chỉ của nhà cung cấp" @if($checkData==1) value="{{$data['dia_chi']}}" @endif disabled="disabled">
                </div>
            </div>

            

            

            <!-- <div class="form-group row">
              <label for="da_thanh_toan" class="col-sm-4 col-form-label ">Tình trạng thanh toán</label>
              <div class="col-sm-8">
                 <div class="icheck-square">
                    <input name="da_thanh_toan" type="checkbox" id="da_thanh_toan" value="1" @if($checkData==1) @if($data['da_thanh_toan']) {{'checked="checked"'}} @endif @endif>
                    <label for="da_thanh_toan">Check vào nếu đã thanh toán</label>
                  </div>
              </div>
            </div> -->



          </div>
          <div class="col-sm-6">
            <div class="form-group row">
              <label for="so_dien_thoai" class="col-sm-4 col-form-label ">Số điện thoại</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control so_dien_thoai" name="so_dien_thoai" placeholder="Số điện thoại của nhà cung cấp" @if($checkData==1) value="{{$data['di_dong']}}" @endif disabled="disabled">
              </div>
            </div>
            <!-- <div class="form-group row">
              <div class="col-12 text-center"><h4 class="text-primary text-center">THÔNG TIN SẢN PHẨM NHẬP</h4></div>
            </div> -->
            <div class="form-group row">
              <label for="ma_san_pham" class="col-sm-4 col-form-label ">Mã sản phẩm</label>
              <div class="col-sm-8">
                 <input type="Text" class="form-control ma_san_pham" name="ma_san_pham" placeholder="Hiển thị mã sản phẩm cần nhập" disabled="disabled">
              </div>
            </div>


            <div class="form-group row">
              <label for="ten_san_pham" class="col-sm-4 col-form-label ">Tên sản phẩm <span class="text-danger">(*)</span></label>
              <div class="col-sm-8 autocomplete">
                 <input type="Text" class="form-control input-autocomplete ten_san_pham" id="ten_san_pham" name="ten_san_pham" placeholder="Chọn sản phẩm cần nhập kho" autocomplete="off" tabindex="5">
              </div>
            </div>


            <div class="form-group row">
                <label for="gia_nhap" class="col-sm-4 col-form-label ">Đơn giá nhập <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control gia_nhap" name="gia_nhap" placeholder="Vui lòng nhập giá nhập của sản phẩm" autocomplete="off" tabindex="6" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
                </div>
            </div>

            <div class="form-group row">
                <label for="so_luong" class="col-sm-4 col-form-label ">Số lượng <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control so_luong" name="so_luong" placeholder="Vui lòng nhập số lượng của sản phẩm" autocomplete="off" tabindex="7" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
                </div>
            </div>

            <div class="form-group row">
                <label for="thanh_tien" class="col-sm-4 col-form-label ">Thành tiền <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                   <input type="Text" class="form-control thanh_tien" name="thanh_tien" placeholder="Vui lòng nhập thành tiền của sản phẩm"  autocomplete="off" tabindex="8" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
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
        $jsonDoiTac="var doiTacs=[";
        foreach ($doiTacs as $key => $doiTac) {
          $jsonDoiTac.='"'.str_replace("'","",str_replace('"',"",$doiTac['ten_doi_tac'])).' - '.$doiTac['ma_doi_tac'].'",';
        }
        $jsonDoiTac.="];";
        echo $jsonDoiTac;
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
      autocomplete(document.getElementById("ten_doi_tac"), doiTacs);
      autocomplete(document.getElementById("ten_san_pham"), sanPhams);

      $('.table').dataTable({
         aLengthMenu: [
          [25, 50, 100, 200, -1],
          [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
      });
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();

      $('.so_luong').on("change", function(e) {
          var soLuong=jQuery('.so_luong').val().replace(/,/g, '');
          var giaNhap=jQuery('.gia_nhap').val().replace(/,/g, '');
          //var thanhTien=jQuery(this).val()*jQuery('.gia_nhap').val();
          var thanhTien=soLuong*giaNhap;
          jQuery('.thanh_tien').val(thanhTien);
      });
      $('.so_luong').on("keypress", function(e) {
          /* ENTER PRESSED*/
          var soLuong=jQuery('.so_luong').val().replace(/,/g, '');
          var giaNhap=jQuery('.gia_nhap').val().replace(/,/g, '');
          //var thanhTien=jQuery(this).val()*jQuery('.gia_nhap').val();
          var thanhTien=soLuong*giaNhap;
          jQuery('.thanh_tien').val(thanhTien);
      });
      $('.so_luong').on("keyup", function(e) {
          /* ENTER PRESSED*/
          var soLuong=jQuery('.so_luong').val().replace(/,/g, '');
          var giaNhap=jQuery('.gia_nhap').val().replace(/,/g, '');
          //var thanhTien=jQuery(this).val()*jQuery('.gia_nhap').val();
          var thanhTien=soLuong*giaNhap;
          jQuery('.thanh_tien').val(thanhTien);
      });

      $('.thanh_tien').on("keypress", function(e) {
        var frmId=jQuery(this).closest('form').attr('id');
          /* ENTER PRESSED*/
          if (e.keyCode == 13) {
              /* FOCUS ELEMENT */
              themChiTietPhieuNhap(_token, $("form#"+frmId), "{{ route('them-chi-tiet-phieu-nhap') }}", "{{ route('load-chi-tiet-phieu-nhap') }}", '.load-chi-tiet');
              jQuery('.ten_san_pham').val('');
              jQuery('.ten_san_pham').focus();
              return false;
          }
      });
      $('.btn-them').on('click', function() {
        var soLuong=jQuery('.so_luong').val().replace(/,/g, '');
        var giaNhap=jQuery('.gia_nhap').val().replace(/,/g, '');
        var thanhTien=soLuong*giaNhap;
        jQuery('.thanh_tien').val(thanhTien);
          
        var frmId=jQuery(this).closest('form').attr('id');
          /* ENTER PRESSED*/
          /* FOCUS ELEMENT */
          themChiTietPhieuNhap(_token, $("form#"+frmId), "{{ route('them-chi-tiet-phieu-nhap') }}", "{{ route('load-chi-tiet-phieu-nhap') }}", '.load-chi-tiet');
          jQuery('.ten_san_pham').val('');
          jQuery('.ten_san_pham').focus();
          return false;
      });

      $('.ngay_nhap').on("keypress", function(e) {
          /* ENTER PRESSED*/
          if (e.keyCode == 13) {
              /* FOCUS ELEMENT */
              jQuery('.ten_doi_tac').focus();
          }
      });


      $('input').on("keypress", function(e) {
          /* ENTER PRESSED*/
          if (e.keyCode == 13) {
              /* FOCUS ELEMENT */
              var value=jQuery(this).val();
              if(value || jQuery(this).hasClass('ten_doi_tac')){
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
        jQuery('.ma_phieu_nhap').focus();
      }, 1000);

      var idPhieuNhap=jQuery('.id').val();
      if(idPhieuNhap){
        jQuery("#modal-cap-nhat").modal('hide');
        jQuery('.btn-xoa-phieu-nhap').attr("data",idPhieuNhap);
        getById(_token, idPhieuNhap, "{{ route('load-chi-tiet-phieu-nhap') }}", '.load-chi-tiet');

      }
            
  </script>

@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif


