@extends('layouts.index')
@section('title', 'Tài khoản')
@section('content')
<div class="modal-body card">
	<div class="row">
      <div class="col-6">
        <h4 class="text-danger">TRÌNH GỬI EMAIL KHÔNG TỰ ĐỘNG</h4>
      </div>
        <div class="col-6">
           <div class="error-mode float-right"></div> 
        </div>
    </div>
  <form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi" action="{{ route('gui-email') }}" method="POST">
  	{{ csrf_field() }}
    <div class="row">
    	<div class="col-8 ">
    		<div class="form-group row">
		        <label for="name" class="col-sm-4 col-form-label ">Địa chỉ email <span class="text-danger">(*)</span></label>
		        <div class="col-sm-8">
		           <input type="Text" class="form-control name" name="email" placeholder="Vui lòng nhập email">
		        </div>
		     </div>
		     <div class="form-group row">
		        <label for="name" class="col-sm-4 col-form-label ">Tiêu đề <span class="text-danger">(*)</span></label>
		        <div class="col-sm-8">
		           <input type="Text" class="form-control name" name="subject" placeholder="Vui lòng nhập tiêu đề muốn gửi">
		        </div>
		     </div>

		     <div class="form-group row">
		        <label for="email" class="col-sm-4 col-form-label ">Nội dung:  <span class="text-danger">(*)</span></label>
		        <div class="col-sm-8">
		           <TEXTAREA class="form-control email" name="noi_dung" ></TEXTAREA>
		        </div>
		     </div>
    	</div>
    	
    </div>
    <div class="row">
    	<div class="col-sm-2- col-8 text-right">
    		<button type="submit" class="btn btn-vnpt">Gửi email</button>
    	</div>
    </div>
  </form>
</div>
@endsection
			