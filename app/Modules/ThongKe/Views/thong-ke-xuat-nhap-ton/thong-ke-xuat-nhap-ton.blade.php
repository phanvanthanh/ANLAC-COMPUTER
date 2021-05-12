@extends('layouts.index')
@section('title', 'Danh mục sản phẩm')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">THỐNG KÊ XUẤT NHẬP TỒN</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
               

                <div class="row">
                  <div class="col-12">
                    <div class="row">
                          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-md-center">
                                  <i class="mdi mdi-basket icon-lg text-success"></i>
                                  <div class="ml-3">
                                    <p class="mb-0">Tổng tiền nhập</p>
                                    <h6>$ {{number_format($thongKeChung['tong_tien_nhap'],0)}}</h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-md-center">
                                  <i class="mdi mdi-rocket icon-lg text-warning"></i>
                                  <div class="ml-3">
                                    <p class="mb-0">Tổng vốn đã xuất</p>
                                    <h6>$ {{number_format($thongKeChung['gia_von_xuat'],0)}}</h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-md-center">
                                  <i class="mdi mdi-diamond icon-lg text-info"></i>
                                  <div class="ml-3">
                                    <p class="mb-0">Doanh thu</p>
                                    <h6>$ {{number_format($thongKeChung['tong_tien_xuat'],0)}}</h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-md-center">
                                  <i class="mdi mdi-chart-line-stacked icon-lg text-danger"></i>
                                  <div class="ml-3">
                                    <p class="mb-0">Lợi nhuận</p>
                                    <h6>
                                        @php 
                                          $doanhThu=$thongKeChung['tong_tien_xuat']-$thongKeChung['gia_von_xuat'];
                                          if($doanhThu<0){
                                            $doanhThu=0;
                                          }
                                        @endphp
                                        $ {{number_format($doanhThu,0)}}
                                    </h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="text-right table-responsive">
                    

                    <div class="btn-group mr-2">
                        <a href="{{ route('export-thong-ke') }}" class="btn btn-sm btn-vnpt btn-export"><i class="fa fa-download"></i> Export xuất nhập tồn</a>
                    </div>
                </div>
                <br>
               <div class="table-responsive load-danh-sach">
                                  
               </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-thong-ke" tabindex="-1" role="dialog" aria-labelledby="modal-thong-ke" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header background-vnpt">
                  <h5 class="modal-title">Thống kê xuất nhập tồn</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample frm-thong-ke" id="frm-thong-ke" name="frm-thong-ke">
                    {{ csrf_field() }}
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-thong-ke"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-thong-ke-xuat-nhap-ton') }}", '.load-danh-sach');
    });
  </script>
@endsection

