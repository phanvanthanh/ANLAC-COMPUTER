@extends('layouts.index')
@section('title', 'Quản lý xuất kho')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/autocomplete.css') }}">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">DANH SÁCH PHIẾU XUẤT KHO</h4>
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
                              <i class="fa fa-shopping-cart icon-lg text-warning"></i>
                              <div class="ml-3">
                                <p class="mb-0">Tổng số phiếu xuất</p>
                                <h6>{{number_format($thongKeChung['tong_so_phieu_xuat'],0)}}</h6>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-md-center">
                              <i class="fa fa-money icon-lg text-success"></i>
                              <div class="ml-3">
                                <p class="mb-0">Tổng tiền</p>
                                <h6>$ {{number_format($thongKeChung['tong_tien_xuat'],0)}}</h6>
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
                      <form class="forms-sample frm-import" id="frm-import" name="frm-import" method="POST" action="{{ route('import-phieu-xuat') }}" enctype="multipart/form-data">
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
                        <button class="btn btn-sm btn-vnpt btn-import"><i class="fa fa-sign-in"></i> Import phiếu xuất</button>
                    </div>

                    <div class="btn-group mr-2">
                        <a href="{{ route('export-phieu-xuat') }}" class="btn btn-sm btn-vnpt btn-export"><i class="fa fa-download"></i> Export phiếu xuất</a>
                    </div>


                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-load-form-them-moi" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Lập phiếu xuất kho</button>
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


    <div class="modal fade" id="modal-them-moi" tabindex="-1" role="dialog" aria-labelledby="modal-them-moi" aria-hidden="true"> <!-- style="margin-top: -85px; height: auto;" -->
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header background-vnpt">
                  <h5 class="modal-title">LẬP PHIẾU XUẤT KHO</h5>
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
                  <button type="button" class="btn btn-vnpt" data-dismiss="modal"><i class="icon-check"></i>Hoàn tất xuất kho</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/js/autocomplete.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-phieu-xuat') }}", '.load-danh-sach');


      $('.btn-load-form-them-moi').on('click',function(){
        getById(_token, "", "{{ route('phieu-xuat-single') }}", ".frm-them-moi"); // gọi sự kiện lấy dữ liệu theo id
      });
      

      $('#modal-them-moi').on('hide.bs.modal', function () {
        location.reload();
      });

      jQuery('.btn-import').on('click',function(){
        jQuery('#frm-import').submit();
      });

      
    });

  </script>
@endsection

