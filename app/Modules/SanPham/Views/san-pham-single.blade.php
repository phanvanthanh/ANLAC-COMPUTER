@if($error=="")
  @php $checkData=0; @endphp
  @php if($data){$checkData=1;} @endphp
        {{ csrf_field() }}
        @if($checkData==1)
        <input type="hidden" name="id" class="id" value="{{$data['id']}}">
        @endif
        <div class="form-group row">
          <label for="ten_san_pham" class="col-sm-4 col-form-label ">Tên sản phẩm</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ten_san_pham" name="ten_san_pham" placeholder="Vui lòng nhập tên sản phẩm" @if($checkData==1) value="{{$data['ten_san_pham']}}" @endif>
          </div>
        </div>

        <div class="form-group row">
          <label for="ma_san_pham" class="col-sm-4 col-form-label ">Mã sản phẩm</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ma_san_pham" name="ma_san_pham" placeholder="Vui lòng nhập mã sản phẩm" @if($checkData==1) value="{{$data['ma_san_pham']}}" @endif>
          </div>
        </div>

        <div class="form-group row">
          <label for="id_don_vi_tinh" class="col-sm-4 col-form-label">Đơn vị tính</label>
          <div class="col-sm-8">
             <select class="form-control id_don_vi_tinh" name="id_don_vi_tinh">
              @foreach($donViTinhs as $donViTinh)
                  <option value="{{$donViTinh['id']}}" @if($checkData==1) @if($data['id_don_vi_tinh']==$donViTinh['id']){{'selected="selected"'}}@endif @endif>
                    {{$donViTinh['ten_don_vi_tinh']}}
                  </option>
              @endforeach
            </select>
          </div>
       </div>

        <div class="form-group row">
          <label for="mo_ta_san_pham" class="col-sm-4 col-form-label ">Mô tả</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control mo_ta_san_pham" name="mo_ta_san_pham" placeholder="Vui lòng nhập mô tả sản phẩm" @if($checkData==1) value="{{$data['mo_ta_san_pham']}}" @endif>
          </div>
        </div>

        <div class="form-group row">
          <label for="hinh_anh" class="col-sm-4 col-form-label ">Hình ảnh</label>
          <div class="col-sm-8">
            <div class="input-group col-xs-12">              
              <input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file hình ảnh, video, word, excel, pdf.">
              <div class="input-group-append">
                <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn hình ảnh</button>         
                <input type="file" class="input-file" show-file=".giz-upload-01" name="hinh_anh[]" multiple hidden="true">
              </div> <br>
            </div>
            <span class="show-file giz-upload-01"></span>
          </div>
        </div>

       

       <div class="form-group row">
          <label for="gia_nhap_goi_y" class="col-sm-4 col-form-label ">Giá nhập (Gợi ý)</label>
          <div class="col-sm-8">
             <input type="Number" class="form-control gia_nhap_goi_y" name="gia_nhap_goi_y" placeholder="Vui lòng nhập gợi ý" @if($checkData==1) value="{{$data['gia_nhap_goi_y']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="gia_xuat_goi_y" class="col-sm-4 col-form-label ">Giá xuất (Gợi ý)</label>
          <div class="col-sm-8">
             <input type="Number" class="form-control gia_xuat_goi_y" name="gia_xuat_goi_y" placeholder="Vui lòng xuất gợi ý" @if($checkData==1) value="{{$data['gia_xuat_goi_y']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="state" class="col-sm-4 col-form-label">Trạng thái</label>
          <div class="col-sm-8">
             <select class="form-control state" name="state">
              <option value="1" @if($checkData==1) @if($data['state']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
              <option value="0" @if($checkData==1) @if($data['state']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
            </select>
          </div>
       </div>   

       <script type="text/javascript" src="{{ asset('public/js/uploadFile.js') }}"></script>
     <script type="text/javascript" src="{{ asset('public/js/showFile.js') }}"></script> 
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif


