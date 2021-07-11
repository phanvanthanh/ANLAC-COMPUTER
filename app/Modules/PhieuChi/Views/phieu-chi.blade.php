@extends('layouts.index')
@section('title', 'Danh mục sản phẩm')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">QUẢN LÝ CHI TIÊU</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>

                <div class="row">
                  <div class="col-3 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-cubes icon-lg text-success"></i>
                              <div class="ml-3">
                                <p class="mb-0">Tổng số phiếu chi</p>
                                <h6>{{number_format($thongKeChung['pc_so_luong'],0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-3 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-money icon-lg text-danger"></i>
                              <div class="ml-3">
                                <p class="mb-0">Tổng chi</p>
                                <h6>$ {{number_format($thongKeChung['pc_tong_chi'],0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
               

                <div class="text-right table-responsive">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-load-form-them-moi" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Lập phiếu chi</button>
                    </div>
                </div>
                <br>
               
            </div>
        </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive load-danh-sach"></div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modal-them-moi" tabindex="-1" role="dialog" aria-labelledby="modal-them-moi" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header background-vnpt">
                  <h5 class="modal-title">LẬP PHIẾU CHI</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi">
                    {{ csrf_field() }}
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i>Lưu</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-phieu-chi') }}", '.load-danh-sach');

      $('.btn-them-moi').on('click',function(){
          themMoi(_token, $("form#frm-them-moi"), "{{ route('them-phieu-chi') }}", "{{ route('danh-sach-phieu-chi') }}", '.load-danh-sach');
          jQuery("#modal-them-moi").modal('hide');
      });

      $('.btn-load-form-them-moi').on('click',function(){
        getById(_token, "", "{{ route('phieu-chi-single') }}", ".frm-them-moi"); // gọi sự kiện lấy dữ liệu theo id
      });
      

      
    });
  </script>
@endsection

