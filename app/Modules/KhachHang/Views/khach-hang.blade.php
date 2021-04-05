@extends('layouts.index')
@section('title', 'Khách hàng')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">DANH SÁCH KHÁCH HÀNG</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>

                <div class="row">
                  <div class="col-2 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-cubes icon-lg text-success"></i>
                              <div class="ml-3">
                                <p class="mb-0">Tổng KH</p>
                                <h6>{{number_format($thongKeChung['kh_so_luong_khach_hang'],0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-money icon-lg text-success"></i>
                              <div class="ml-3">
                                <p class="mb-0">Doanh thu</p>
                                <h6>{{number_format($thongKeChung['kh_tong_thanh_tien'],0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-sort-numeric-desc icon-lg text-warning"></i>
                              <div class="ml-3">
                                <p class="mb-0">Giảm giá</p>
                                <h6>{{number_format($thongKeChung['kh_tong_giam_gia'],0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-money icon-lg text-warning"></i>
                              <div class="ml-3">
                                <p class="mb-0">Thanh toán</p>
                                <h6>{{number_format($thongKeChung['kh_da_thanh_toan'],0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-money icon-lg text-danger"></i>
                              <div class="ml-3">
                                <p class="mb-0">KH nợ</p>
                                @php
                                  $tongKhachHangNo=$thongKeChung['kh_tong_thanh_tien']-($thongKeChung['kh_tong_giam_gia']+$thongKeChung['kh_da_thanh_toan']);
                                @endphp
                                <h6>$ {{number_format($tongKhachHangNo,0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
               

                <div class="text-right table-responsive">
                    <div class="btn-group mr-2">
                      <form class="forms-sample frm-import" id="frm-import" name="frm-import" method="POST" action="{{ route('import-khach-hang') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-group col-xs-12">              
                          <input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file excel">
                          <div class="input-group-append">
                            <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn file</button>         
                            <input type="file" class="input-file" show-file=".giz-upload-01" name="file" multiple hidden="true">
                          </div> 
                        </div>
                      </form>
                    </div>

                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-import"><i class="mdi mdi-plus-circle-outline"></i> Import khách hàng</button>
                    </div>


                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-load-form-them-moi" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Thêm khách hàng</button>
                    </div>
                </div>
                <br>
               <div class="table-responsive load-danh-sach">
                                  
               </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-them-moi" tabindex="-1" role="dialog" aria-labelledby="modal-them-moi" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header background-vnpt">
                  <h5 class="modal-title">THÊM MỚI THÔNG TIN KHÁCH HÀNG</h5>
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
                  <button type="button" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i>Thêm</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-khach-hang') }}", '.load-danh-sach');

      $('.btn-them-moi').on('click',function(){
          themMoi(_token, $("form#frm-them-moi"), "{{ route('them-khach-hang') }}", "{{ route('danh-sach-khach-hang') }}", '.load-danh-sach');
          jQuery("#modal-them-moi").modal('hide');
      });

      $('.btn-load-form-them-moi').on('click',function(){
        getById(_token, "", "{{ route('khach-hang-single') }}", ".frm-them-moi"); // gọi sự kiện lấy dữ liệu theo id
      });
      

      
    });
  </script>
@endsection

