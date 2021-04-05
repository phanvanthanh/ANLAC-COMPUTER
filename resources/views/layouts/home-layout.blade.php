<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Tra cứu Nhà Đất </title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>
    <link rel="stylesheet" href="{{ asset('public/template-slider/dist/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
      @import url("//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

      .navbar-icon-top .navbar-nav .nav-link > .fa {
        position: relative;
        width: 36px;
        font-size: 24px;
      }

      .navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
        font-size: 0.75rem;
        position: absolute;
        right: 0;
        font-family: sans-serif;
      }

      .navbar-icon-top .navbar-nav .nav-link > .fa {
        top: 3px;
        line-height: 12px;
      }

      .navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
        top: -10px;
      }

      @media (min-width: 576px) {
        .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link {
          text-align: center;
          display: table-cell;
          height: 70px;
          vertical-align: middle;
          padding-top: 0;
          padding-bottom: 0;
        }

        .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa {
          display: block;
          width: 48px;
          margin: 2px auto 4px auto;
          top: 0;
          line-height: 24px;
        }

        .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa > .badge {
          top: -7px;
        }
      }

      @media (min-width: 768px) {
        .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link {
          text-align: center;
          display: table-cell;
          height: 70px;
          vertical-align: middle;
          padding-top: 0;
          padding-bottom: 0;
        }

        .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa {
          display: block;
          width: 48px;
          margin: 2px auto 4px auto;
          top: 0;
          line-height: 24px;
        }

        .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa > .badge {
          top: -7px;
        }
      }

      @media (min-width: 992px) {
        .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link {
          text-align: center;
          display: table-cell;
          height: 70px;
          vertical-align: middle;
          padding-top: 0;
          padding-bottom: 0;
        }

        .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa {
          display: block;
          width: 48px;
          margin: 2px auto 4px auto;
          top: 0;
          line-height: 24px;
        }

        .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa > .badge {
          top: -7px;
        }
      }

      @media (min-width: 1200px) {
        .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link {
          text-align: center;
          display: table-cell;
          height: 70px;
          vertical-align: middle;
          padding-top: 0;
          padding-bottom: 0;
        }

        .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa {
          display: block;
          width: 48px;
          margin: 2px auto 4px auto;
          top: 0;
          line-height: 24px;
        }

        .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa > .badge {
          top: -7px;
        }
      }
      nav.navbar a{
        color: white;
      }
      nav.navbar a:hover,nav.navbar a:active,nav.navbar a:focus{
        color: #fd3838;
      }
      nav.navbar{
        position: fixed;
            z-index: 10000;
            margin-top: -10px;
            height: 60px;
      }

    </style>


</head>
<body>
  <div class="container-fluid">
    <div class="content-wrapper">

      <nav class="navbar navbar-icon-top navbar-expand-lg" style="width: 102%;margin-left: -1%; background-color: #1e1f26;" >
        <a class="navbar-brand" href="#">
          <!-- <img src="{{ asset('public/images/logo.jpg') }}" width="80" height="50" class="d-inline-block align-top" alt=""> -->
          <i class="fa fa-home"></i> TRA CỨU NHÀ ĐẤT
        </a>
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">
                <i class="fa fa-home"></i>
                <!-- Home -->
                <!-- <span class="sr-only">(current)</span> -->
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa fa-envelope-o">
                  <span class="badge badge-danger">11</span>
                </i>
                <!-- Link -->
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">
                <!-- <i class="fa fa-envelope-o">
                  <span class="badge badge-warning">11</span>
                </i> -->
                Disabled
              </a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-envelope-o">
                  <span class="badge badge-primary">11</span>
                </i> 
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li> -->
          </ul>
          <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa fa-bell">
                  <span class="badge badge-info">11</span>
                </i>
                <!-- Test -->
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa fa-globe">
                  <span class="badge badge-success">11</span>
                </i>
                <!-- Test -->
              </a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
          </form>
          <a class="navbar-brand" href="#">&nbsp;</a>
        </div>
      </nav>

      <div class="grid-margin">
        @yield('content')
      </div>
    </div>
  </div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>
  <script type="text/javascript" src="{{ asset('public/template-slider/dist/script.js') }}"></script>

  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>








</body>
</html>

