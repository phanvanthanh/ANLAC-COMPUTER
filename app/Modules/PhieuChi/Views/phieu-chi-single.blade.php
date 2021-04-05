@if($error=="")
  @php $checkData=0; @endphp
  @php if($data){$checkData=1;} @endphp
        {{ csrf_field() }}
        @if($checkData==1)
        <input type="hidden" name="id" class="id" value="{{$data['id']}}">
        @endif
        <div class="form-group row">
          <label for="ma_phieu_chi" class="col-sm-4 col-form-label ">Mã phiếu chi <b class="text-danger">(*)</b></label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ma_phieu_chi" name="ma_phieu_chi" placeholder="Vui lòng nhập tổng số tiền chi" @if($checkData==1 && isset($data['ma_phieu_chi'])) value="{{$data['ma_phieu_chi']}}" @else value="{{$maPhieuChi}}" @endif>
          </div>
        </div>

        <div class="form-group row">
          <label for="noi_dung" class="col-sm-4 col-form-label ">Nội dung chi</label>
          <div class="col-sm-8">
             <TEXTAREA class="form-control noi_dung" name="noi_dung" placeholder="Vui lòng nhập nội dung" rows="5">@if($checkData==1) {{$data['noi_dung']}} @endif</TEXTAREA>
          </div>
        </div>

        <div class="form-group row">
          <label for="tong_chi" class="col-sm-4 col-form-label ">Tổng chi <b class="text-danger">(*)</b></label>
          <div class="col-sm-8">
             <input type="Number" class="form-control tong_chi" name="tong_chi" placeholder="Vui lòng nhập tổng số tiền chi" @if($checkData==1) value="{{$data['tong_chi']}}" @endif>
          </div>
        </div>

        

        <div class="form-group row">
          <label for="ghi_chu" class="col-sm-4 col-form-label ">Ghi chú</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ghi_chu" name="ghi_chu" placeholder="Vui lòng nhập ghi chú" @if($checkData==1) value="{{$data['ghi_chu']}}" @endif>
          </div>
        </div>

        

        <div class="form-group row">
          <label for="file" class="col-sm-4 col-form-label ">File phiếu chi (nếu có)</label>
          <div class="col-sm-8">
            <div class="input-group col-xs-12">              
              <input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file hình ảnh, video, word, excel, pdf.">
              <div class="input-group-append">
                <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn file</button>         
                <input type="file" class="input-file" show-file=".giz-upload-01" name="file[]" multiple hidden="true">
              </div> <br>
            </div>
            <span class="show-file giz-upload-01"></span>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-4">&nbsp;</div>
          <div class="col-8">
            <div class="icheck-square">
                <input name="da_duyet" type="checkbox" id="da_duyet" value="1" @if($checkData==1) @if($data['da_duyet']) {{"checked='checked'"}} @endif @endif>
                <label for="da_duyet">Đã được duyệt</label>
            </div>
          </div>
        </div> -->
       <script type="text/javascript" src="{{ asset('public/js/uploadFile.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/showFile.js') }}"></script> 
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif


