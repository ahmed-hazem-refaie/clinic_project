<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
///








<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

////
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

            background: #111;

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


        .modal-confirm {		
	color: #636363;
	width: 325px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}	
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}	
.modal-confirm .icon-box {
	color: #fff;		
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #ef513a;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 56px;
	position: relative;
	top: 4px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #ef513a;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #da2c12;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
    </style>
    @stack('locationpicker')

</head>


<nav>
    <div>
        <p class="head">Clinic System</p>
        <button type="button" name="create_record" id="create_record" class="btn  create btn-primary btn-sm"><i class="fa fa-home" aria-hidden="true"></i></button>
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

    <!-- Modal HTML -->
<div id="modalerror" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="fa fa-times fa-4x" aria-hidden="true"></i>
				</div>				
				<h4 class="modal-title w-100">Sorry!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center" id="modalerrormsg"></p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div> 

    <!-- Modal HTML -->
    <div id="modalsucces" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box" style="background-color: yellowgreen">
                        <i class="fa fa-check fa-4x" aria-hidden="true"></i>
                    </div>				
                    <h4 class="modal-title w-100">Great!</h4>	
                </div>
                <div class="modal-body">
                    <p class="text-center" id="modalsuccesmsg"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" style="background-color: yellowgreen"  data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div> 


    @yield('adminbase')

</div>


    @yield('scripts')
</html>
