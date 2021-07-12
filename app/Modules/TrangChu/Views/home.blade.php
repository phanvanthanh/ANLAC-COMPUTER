@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')
@php
	$loiNhuanTheoThang=$thongKeChung['loi_nhuan_theo_thang'];
@endphp
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
      <div class="row">
      	<div class="col-12">&nbsp;</div>
      </div>
      <div class="row">
      	<div class="col-12">
      		<div class="card"><br>
      			<h6 class="card-title text-success" style="margin-left:30px;">
      				Tổng lợi nhuận theo từng tháng (năm @php echo date('Y'); @endphp)
      			</h6>
      			<div class="row text-center text-danger w-100 h-100" style="margin-bottom: -10px; z-index: 1000;">
      				@php
				    		/*for($i=1; $i<=6; $i++){
				    			$j=$i;
				    			if($i<10){
				    				$j='0'.$i;
				    			}
					    		if(isset($loiNhuanTheoThang[$j])){
						    		echo '<div class="col-2">'.($loiNhuanTheoThang[$j]['loi_nhuan']/1000000).'</div>';
					    		}else{
					    			echo '<div class="col-2"></div>';
					    		}
					    	}*/
				    	@endphp
      				
      			</div>
      		</div>
      	</div>
      	{{-- <div class="col-6">
      		<div class="card"><br>
      			<h6 class="card-title text-info" style="margin-left:30px;">
      				Lợi nhuận 6 tháng cuối năm (Đơn vị tính: Triệu đồng)
      			</h6>
      			<div class="row text-center text-primary w-100 h-100" style="margin-bottom: -10px; z-index: 1000;">
      				@php
				    		/*for($i=7; $i<=12; $i++){
				    			$j=$i;
				    			if($i<10){
				    				$j='0'.$i;
				    			}
					    		if(isset($loiNhuanTheoThang[$j])){
						    		echo '<div class="col-2">'.($loiNhuanTheoThang[$j]['loi_nhuan']/1000000).'</div>';
					    		}else{
					    			echo '<div class="col-2">12.000</div>';
					    		}
					    	}*/
				    	@endphp
      				
      			</div>
      		</div>
      	</div> --}}
      </div>
	    <div class="row">
	    	<div class="col-12 col-md-12 col-lg-12 grid-margin stretch-card">	    		
          <div class="card">
            <div class="text-white py-3 px-4">              
              <div class="chart-container">
                <canvas class="w-100 h-100" id="dashboard-column-1" style="height: 500px !important;"></canvas>
              </div>              
            </div>
          </div>
        </div>
        {{-- <div class="col-6 col-md-6 col-lg-6 grid-margin stretch-card">
          <div class="card">
            <div class="text-white py-3 px-4">
              <div class="chart-container">
                <canvas class="w-100 h-100" id="dashboard-column-2" style="height: 250px !important;"></canvas>
              </div>
            </div>
          </div>
        </div> --}}
	    </div>
{{-- 	    <div class="row">
	    	
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
	    </div> --}}
	    
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
			/*Biểu đồ cột 1*/
	    var data = {
		    labels: [
		    	@php
			    	for($i=1; $i<=12; $i++){
		    			$j=$i;
		    			if($i<10){
		    				$j='0'.$i;
		    			}
			    		if(isset($loiNhuanTheoThang[$j])){			    			
				    		echo '"'.$loiNhuanTheoThang[$j]['thang_xuat'].'"';				    			
				    		if ($i<12){
				    			echo ",";
				    		}
			    		}else{
			    			echo '"'.$j.'"';				    			
				    		if ($i<12){
				    			echo ",";
				    		}
			    		}
			    	}
		    	@endphp
		    	
		    ],
		    datasets: [{
		      label: '# Giá trị (Triệu đồng)',
		      data: [
		      	@php
			    		for($i=1; $i<=12; $i++){
			    			$j=$i;
			    			if($i<10){
			    				$j='0'.$i;
			    			}
				    		if(isset($loiNhuanTheoThang[$j])){
					    		echo ($loiNhuanTheoThang[$j]['loi_nhuan']/1000000);
					    		if ($i<12){
					    			echo ",";
					    		}
				    		}else{
					    		echo 0;				    		
					    		if ($i<12){
					    			echo ",";
					    		}
				    		}
				    	}
			    	@endphp
		      ],
		      backgroundColor: [
		      @php
		    		for($i=1; $i<=12; $i++){
		    			echo "'rgb(0, 194, 146)'";
		    			if($i<12){
		    				echo ",";
		    			}
		    		}
		    	@endphp
		      ],
		      borderColor: [
		        @php
			    		for($i=1; $i<=12; $i++){
			    			echo "'rgb(0, 194, 146)'";
			    			if($i<12){
			    				echo ",";
			    			}
			    		}
			    	@endphp
		      ],
		      borderWidth: 1
		    }]
		  };

		  var options = {
		    scales: {
		      yAxes: [{
		        ticks: {
		          beginAtZero: true
		        }
		      }]
		    },
		    legend: {
		      display: true
		    },
		    elements: {
		      point: {
		        radius: 0
		      }
		    }

		  };

		  if ($("#dashboard-column-1").length) {
		    var barChartCanvas = $("#dashboard-column-1").get(0).getContext("2d");
		    // This will get the first returned node in the jQuery collection.
		    var barChart = new Chart(barChartCanvas, {
		      type: 'bar',
		      data: data,
		      options: options
		    });
		  }
		  /*End biểu đồ cột 1*/

			/*Biểu đồ cột 2*/
	    /*var data = {
		    labels: [
		    	@php
			    	for($i=7; $i<=12; $i++){
		    			$j=$i;
		    			if($i<10){
		    				$j='0'.$i;
		    			}
			    		if(isset($loiNhuanTheoThang[$j])){			    			
				    		echo '"'.$loiNhuanTheoThang[$j]['thang_xuat'].'"';				    			
				    		if ($i<12){
				    			echo ",";
				    		}
			    		}else{
			    			echo '"'.$j.'"';				    			
				    		if ($i<12){
				    			echo ",";
				    		}
			    		}
			    	}
		    	@endphp
		    	
		    ],
		    datasets: [{
		      label: '# Giá trị (Triệu đồng)',
		      data: [
		      	@php
			    		for($i=7; $i<=12; $i++){
			    			$j=$i;
			    			if($i<10){
			    				$j='0'.$i;
			    			}
				    		if(isset($loiNhuanTheoThang[$j])){
					    		echo ($loiNhuanTheoThang[$j]['loi_nhuan']/1000000);
					    		if ($i<12){
					    			echo ",";
					    		}
				    		}else{
					    		echo 0;				    		
					    		if ($i<12){
					    			echo ",";
					    		}
				    		}
				    	}
			    	@endphp
		      ],
		      backgroundColor: [
		      @php
		    		for($i=7; $i<=12; $i++){
		    			echo "'rgb(171, 140, 228)'";
		    			if($i<12){
		    				echo ",";
		    			}
		    		}
		    	@endphp
		      ],
		      borderColor: [
		        @php
			    		for($i=7; $i<=12; $i++){
			    			echo "'rgb(171, 140, 228)'";
			    			if($i<12){
			    				echo ",";
			    			}
			    		}
			    	@endphp
		      ],
		      borderWidth: 1
		    }]
		  };

		  var options = {
		    scales: {
		      yAxes: [{
		        ticks: {
		          beginAtZero: true
		        }
		      }]
		    },
		    legend: {
		      display: false
		    },
		    elements: {
		      point: {
		        radius: 0
		      }
		    }

		  };

		  if ($("#dashboard-column-2").length) {
		    var barChartCanvas = $("#dashboard-column-2").get(0).getContext("2d");
		    // This will get the first returned node in the jQuery collection.
		    var barChart = new Chart(barChartCanvas, {
		      type: 'bar',
		      data: data,
		      options: options
		    });
		  }*/
		  /*End biểu đồ cột 2*/


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


