@extends('layouts.index')
@section('title', 'Danh mục sản phẩm')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">QUẢN LÝ CÔNG NỢ</h4>
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
                                <p class="mb-0">Tổng số KH nợ</p>
                                <h6>{{number_format($thongKeChung['cn_so_khach_hang_con_no'],0)}}</h6>
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
                                <p class="mb-0">Tổng tiền KH nợ</p>
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
                <h5 class="modal-title">THÊM MỚI ĐỐI TÁC</h5>
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
      loadTable(_token, "{{ route('danh-sach-cong-no') }}", '.load-danh-sach');
      
    });
  </script>
@endsection

