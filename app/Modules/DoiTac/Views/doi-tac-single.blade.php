@php use App\DoiTac; @endphp
@if($error=="")
  @php $checkData=0; @endphp
  @php if($data){$checkData=1;} @endphp
        {{ csrf_field() }}
        @if($checkData==1)
        <input type="hidden" name="id" class="id" value="{{$data['id']}}">
        @endif
        @php $maDoiTac=DoiTac::taoMa(); @endphp
        <div class="form-group row">
          <label for="ten_doi_tac" class="col-sm-4 col-form-label ">Tên đối tác</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ten_doi_tac" name="ten_doi_tac" placeholder="Vui lòng nhập tên đối tác" @if($checkData==1) value="{{$data['ten_doi_tac']}}" @endif>
          </div>
        </div>

        <div class="form-group row">
          <label for="ma_doi_tac" class="col-sm-4 col-form-label ">Mã đối tác</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ma_doi_tac" name="ma_doi_tac" placeholder="Vui lòng nhập mã đối tác" @if($checkData==1) value="{{$data['ma_doi_tac']}}" @else value="{{$maDoiTac}}" @endif>
          </div>
        </div>

        <div class="form-group row">
          <label for="gioi_tinh" class="col-sm-4 col-form-label">Giới tính</label>
          <div class="col-sm-8">
             <select class="form-control gioi_tinh" name="gioi_tinh">
              <option value="1" @if($checkData==1) @if($data['gioi_tinh']==1){{'selected="selected"'}}@endif @endif>Nam</option>
              <option value="0" @if($checkData==1) @if($data['gioi_tinh']==0){{'selected="selected"'}}@endif @endif>Nữ</option>
            </select>
          </div>
       </div>

        <div class="form-group row">
          <label for="ten_cong_ty" class="col-sm-4 col-form-label ">Công ty</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ten_cong_ty" name="ten_cong_ty" placeholder="Vui lòng nhập mô tả sản phẩm" @if($checkData==1) value="{{$data['ten_cong_ty']}}" @endif>
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
          <label for="dia_chi" class="col-sm-4 col-form-label ">Địa chỉ</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control dia_chi" name="dia_chi" placeholder="Vui lòng nhập địa chỉ" @if($checkData==1) value="{{$data['dia_chi']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="di_dong" class="col-sm-4 col-form-label ">Di động</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control di_dong" name="di_dong" placeholder="Vui lòng nhập số điện thoại di động" @if($checkData==1) value="{{$data['di_dong']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="co_dinh" class="col-sm-4 col-form-label ">Cố định</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control co_dinh" name="co_dinh" placeholder="Vui lòng nhập số điện thoại cố định" @if($checkData==1) value="{{$data['co_dinh']}}" @endif>
          </div>
       </div>

       <div class="form-group row d-none">
          <label for="email" class="col-sm-4 col-form-label ">Địa chỉ email</label>
          <div class="col-sm-8">
             <input type="email" class="form-control email" name="email" placeholder="Vui lòng nhập địa chỉ email" @if($checkData==1) value="{{$data['email']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="fax" class="col-sm-4 col-form-label ">Cố định</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control fax" name="fax" placeholder="Vui lòng nhập số fax" @if($checkData==1) value="{{$data['fax']}}" @endif>
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


