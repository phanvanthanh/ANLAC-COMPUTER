@extends('layouts.index')
@section('title', 'Dashboard')
@section('content')
	<div class="col-12">
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
                        <p class="mb-0">Lãi lỗ</p>
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
	    <div class="row">
	    	<div class="col-6 col-md-6 col-lg-6 grid-margin stretch-card">
              <div class="card bg-info">
                <div class="text-white py-3 px-4">
                  <h6 class="card-title text-white mb-0">Tổng đơn nhập hàng theo tháng</h6>
                  <p>120 đơn</p>
                  <div class="chart-container">
                    <canvas class="w-100 h-100" id="dashboard-lineChart-1" height="150"></canvas>
                  </div>
                  <small class="text-white">Xem chi tiết</small>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-6 grid-margin stretch-card">
              <div class="card bg-success">
                <div class="text-white py-3 px-4">
                  <h6 class="card-title text-white mb-0">Tổng đơn xuất hàng theo tháng</h6>
                  <p>120 đơn</p>
                  <div class="chart-container">
                    <canvas class="w-100 h-100" id="dashboard-lineChart-2" height="150"></canvas>
                  </div>
                  <small class="text-white">Xem chi tiết</small>
                </div>
              </div>
            </div>
	    </div>
	    <div class="row">
	    	
            <div class="col-6 col-md-6 col-lg-6 grid-margin stretch-card">
              <div class="card bg-success">
                <div class="text-white py-3 px-4">
                  <h6 class="card-title text-white mb-0">Tổng giá trị nhập hàng theo tháng</h6>
                  <p>120 đơn</p>
                  <div class="chart-container">
                    <canvas class="w-100 h-100" id="dashboard-lineChart-4" height="150"></canvas>
                  </div>
                  <small class="text-white">Xem chi tiết</small>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-6 grid-margin stretch-card">
              <div class="card bg-info">
                <div class="text-white py-3 px-4">
                  <h6 class="card-title text-white mb-0">Tổng giá trị xuất hàng theo tháng</h6>
                  <p>120 đơn</p>
                  <div class="chart-container">
                    <canvas class="w-100 h-100" id="dashboard-lineChart-3" height="150"></canvas>
                  </div>
                  <small class="text-white">Xem chi tiết</small>
                </div>
              </div>
            </div>
	    </div>
	    <!-- <div class="row">
	    	<div class="col-md-6 col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Daily Sales</h6>
                  <div class="w-75 mx-auto">
                    <div class="d-flex justify-content-between text-center">
                      <div class="wrapper">
                        <h4>$2256</h4>
                        <small class="text-muted">Totel sales</small>
                      </div>
                      <div class="wrapper">
                        <h4>584</h4>
                        <small class="text-muted">Compaign</small>
                      </div>
                    </div>
                    <div id="dashboard-donut-chart" style="height:250px"></div>
                  </div>
                  <div id="legend" class="donut-legend"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Total Revenue</h6>
                  <div class="w-75 mx-auto">
                    <div class="d-flex justify-content-between text-center mb-5">
                      <div class="wrapper">
                        <h4>6,256</h4>
                        <small class="text-muted">Totel sales</small>
                      </div>
                      <div class="wrapper">
                        <h4>8569</h4>
                        <small class="text-muted">Open Compaign</small>
                      </div>
                    </div>
                  </div>
                  <div id="morris-line-example" style="height:250px;"></div>
                  <div class="w-75 mx-auto">
                    <div class="d-flex justify-content-between text-center mt-5">
                      <div class="wrapper">
                        <h4>5136</h4>
                        <small class="text-muted">Online Sales</small>
                      </div>
                      <div class="wrapper">
                        <h4>4596</h4>
                        <small class="text-muted">Store Sales</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
	    </div> -->
	</div>


    
    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
    <!-- plugins:js -->
	<!-- <script src="{{ asset('public/vendors/js/vendor.bundle.base.js') }}"></script> -->
	<!-- endinject -->
	<!-- Plugin js for this page-->
	<script src="{{ asset('public/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
	<script src="{{ asset('public/vendors/chart.js/Chart.min.js') }}"></script>
	<script src="{{ asset('public/vendors/raphael/raphael.min.js') }}"></script>
	<script src="{{ asset('public/vendors/morris.js/morris.min.js') }}"></script>
	<script src="{{ asset('public/vendors/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
	<!-- End plugin js for this page-->
	<!-- Custom js for this page-->
	<script src="{{ asset('public/js/dashboard.js') }}"></script>
	<!-- End custom js for this page-->
	<script type="text/javascript">
	jQuery(document).ready(function() {

	  	if ($("#dashboard-lineChart-1").length) {
	      var lineChartCanvas = $("#dashboard-lineChart-1").get(0).getContext("2d");
	      var lineChart = new Chart(lineChartCanvas, {
	        type: 'line',
	        data: {
	          labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
	          datasets: [{
	            data: [2, 4, 3, 3, 2, 3],
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            backgroundColor: [
	              'rgba(0,0,0,0)'
	            ],
	            borderColor: [
	              '#caa8f9'
	            ],
	            borderWidth: 1
	          }]
	        },
	        options: {
	          responsive: true,
	          maintainAspectRatio: true,
	          scales: {
	            xAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false
	              },
	              ticks: {
	                display: false,
	              }
	            }],
	            yAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false,
	              },
	              ticks: {
	                display: false,
	              }
	            }]
	          },
	          legend: {
	            display: false
	          },
	          tooltips: {
	            enabled: false
	          },
	          layout: {
	            padding: {
	              top: 5,
	              bottom: 5
	            }
	          }
	        }
	      });
	    }
	    if ($("#dashboard-lineChart-2").length) {
	      var lineChartCanvas = $("#dashboard-lineChart-2").get(0).getContext("2d");
	      var lineChart = new Chart(lineChartCanvas, {
	        type: 'line',
	        data: {
	          labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
	          datasets: [{
	            data: [2, 4, 3, 3, 2, 3],
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            backgroundColor: [
	              'rgba(0,0,0,0)'
	            ],
	            borderColor: [
	              '#fff'
	            ],
	            borderWidth: 1
	          }]
	        },
	        options: {
	          responsive: true,
	          maintainAspectRatio: true,
	          scales: {
	            xAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false
	              },
	              ticks: {
	                display: false,
	              }
	            }],
	            yAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false,
	              },
	              ticks: {
	                display: false,
	              }
	            }]
	          },
	          legend: {
	            display: false
	          },
	          tooltips: {
	            enabled: false
	          },
	          layout: {
	            padding: {
	              top: 5,
	              bottom: 5
	            }
	          }
	        }
	      });
	    }


	    if ($("#dashboard-lineChart-3").length) {
	      var lineChartCanvas = $("#dashboard-lineChart-3").get(0).getContext("2d");
	      var lineChart = new Chart(lineChartCanvas, {
	        type: 'line',
	        data: {
	          labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
	          datasets: [{
	            data: [2, 4, 3, 3, 2, 3],
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            backgroundColor: [
	              'rgba(0,0,0,0)'
	            ],
	            borderColor: [
	              '#fff'
	            ],
	            borderWidth: 1
	          }]
	        },
	        options: {
	          responsive: true,
	          maintainAspectRatio: true,
	          scales: {
	            xAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false
	              },
	              ticks: {
	                display: false,
	              }
	            }],
	            yAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false,
	              },
	              ticks: {
	                display: false,
	              }
	            }]
	          },
	          legend: {
	            display: false
	          },
	          tooltips: {
	            enabled: false
	          },
	          layout: {
	            padding: {
	              top: 5,
	              bottom: 5
	            }
	          }
	        }
	      });
	    }

	    if ($("#dashboard-lineChart-4").length) {
	      var lineChartCanvas = $("#dashboard-lineChart-4").get(0).getContext("2d");
	      var lineChart = new Chart(lineChartCanvas, {
	        type: 'line',
	        data: {
	          labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
	          datasets: [{
	            data: [2, 4, 3, 3, 2, 3],
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            backgroundColor: [
	              'rgba(0,0,0,0)'
	            ],
	            borderColor: [
	              '#caa8f9'
	            ],
	            borderWidth: 1
	          }]
	        },
	        options: {
	          responsive: true,
	          maintainAspectRatio: true,
	          scales: {
	            xAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false
	              },
	              ticks: {
	                display: false,
	              }
	            }],
	            yAxes: [{
	              gridLines: {
	                drawBorder: false,
	                display: false,
	              },
	              ticks: {
	                display: false,
	              }
	            }]
	          },
	          legend: {
	            display: false
	          },
	          tooltips: {
	            enabled: false
	          },
	          layout: {
	            padding: {
	              top: 5,
	              bottom: 5
	            }
	          }
	        }
	      });
	    }

	  
	});
	</script>
@endsection


