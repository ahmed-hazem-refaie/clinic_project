<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        body{
            background: linear-gradient(to left , rgba(0,0,0,0.7 ),rgba(0,0,0,.7) ) ,
             url(/images/wallpaper.jpg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            overflow-x: hidden;
            min-height: 900px;
            height: 100%;
            color: #18dcff;
            font-size: 16px;
            animation: move 2s ease;
        }
        @keyframes move{
            0%{
                transform: scale(0) rotate(360deg) ;

            }
            100%{
                transform: scale(1);
            }
        }
        table{
            color: white!important;
        }
        nav {

            background: #203f61;

            padding: 13px 73px;
        }

        nav .head {
            color: white;
            font-weight: bolder;
            font-size: 21px;
        }
        nav > div {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }
        .create {
            font-size: larger;
        }
    </style>
    @stack('locationpicker')

</head>


<nav>
    <div>
        <p class="head">Clinic Management System</p>
        <button type="button" name="create_record" id="create_record" class="btn  create btn-success btn-sm">Create Employee</button>
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         {{ __('Logout') }}
     </a>
     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    </div>




</nav>










<div class="container">
    @yield('content')

</div>

</html>
