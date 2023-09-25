<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body,html{
			height: 100%;
			margin: 0;
			background: #343541;
			/* background: #7F7FD5;
	       background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
	        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5); */
		}

		.chat{
			margin-top: auto;
			margin-bottom: auto;
		}
		.card{
			height: 90vh;
			border-radius: 15px !important;
			background-color: rgba(183, 206, 250, 0.4) !important;
			width: 100%;
			border: 0px;
		}
		.contacts_body{
			padding:  0.75rem 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.msg_card_body{
			overflow-y: auto;
		}
		.card-header{
			border-radius: 15px 15px 0 0 !important;
			border-bottom: 0 !important;
			/* background: grey; */
		}
	 .card-footer{
		border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
	}
		.container{
			align-content: center;
		}
		.search{
			border-radius: 15px 0 0 15px !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
		}
		.search:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
			.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.attach_btn{
	border-radius: 15px 0 0 15px !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.send_btn{
	border-radius: 0 15px 15px 0 !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.search_btn{
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.contacts{
			list-style: none;
			padding: 0;
		}
		.contacts li{
			width: 100% !important;
			padding: 5px 10px;
			margin-bottom: 15px !important;
		}
	.active{
			background-color: rgba(0,0,0,0.3);
	}
		.user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;
		
		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
	.img_cont{
			position: relative;
			height: 70px;
			width: 70px;
	}
	.img_cont_msg{
			height: 40px;
			width: 40px;
	}
	.online_icon{
		position: absolute;
		height: 15px;
		width:15px;
		background-color: #4cd137;
		border-radius: 50%;
		bottom: 0.2em;
		right: 0.4em;
		border:1.5px solid white;
	}
	.offline{
		background-color: #c23616 !important;
	}
	.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	.user_info p{
	font-size: 10px;
	color: rgba(255,255,255,0.6);
	}
	.video_cam{
		margin-left: 50px;
		margin-top: 5px;
	}
	.video_cam span{
		color: white;
		font-size: 20px;
		cursor: pointer;
		margin-right: 20px;
	}
	.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #e4e4e4;
		padding: 10px;
		position: relative;
	}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-right: 10px;
		border-radius: 25px;
		background-color: #bedeff;
		padding: 10px;
		position: relative;
		max-width: 85vw;
	}
	.msg_time{
		position: absolute;
		left: 0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_time_send{
		position: absolute;
		right:0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_head{
		position: relative;
	}
	#action_menu_btn{
		position: absolute;
		right: 10px;
		top: 10px;
		color: white;
		cursor: pointer;
		font-size: 20px;
	}
	.action_menu{
		z-index: 1;
		position: absolute;
		padding: 15px 0;
		background-color: rgba(0,0,0,0.5);
		color: white;
		border-radius: 15px;
		top: 30px;
		right: 15px;
		display: none;
	}
	.action_menu ul{
		list-style: none;
		padding: 0;
	margin: 0;
	}
	.action_menu ul li{
		width: 100%;
		padding: 10px 15px;
		margin-bottom: 5px;
	}
	.action_menu ul li i{
		padding-right: 10px;
	
	}
	.action_menu ul li:hover{
		cursor: pointer;
		background-color: rgba(0,0,0,0.2);
	}
	.code-block {
        background-color: rgb(40, 40, 40);
        color: white;
		border-radius: 20px;
        padding: 10px; /* Add some padding for readability */
		margin-top: 10px;
		margin-bottom: 10px;
    }


	/* loading pencil icon */
	.editInfo{
  width: 30px;
	height: 30px;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	position: absolute;
  z-index:10;
	left: 50%;
  top:50%;
	display: block;
	background: #fdb833;
	margin: -25px 0 0 -25px;
	color: #6d4a07;
	line-height: 25px;
	font-size: 25px;
	text-align: center;
  -webkit-animation: ring-button 3s infinite; 
	-moz-animation:    ring-button 3s infinite;
	-o-animation:      ring-button 3s infinite;
	animation:         ring-button 3s infinite;
}
.icon-pencil{
  font-weight:bold;
  font-size:17px;
  color:#7f580d;
  text-align:center;
  margin-top:-10px;
}
.editInfo:after{
  background:rgba(253, 184, 51, 0.25);
  border: solid 1px rgba(253, 184, 51, 0.25);
	position: absolute;
  z-index:-1;
	left: 0;
	top: 0;
	width: 30px;
	height: 30px;
	content: "";
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-webkit-animation: ring-line 2.95s infinite; 
	-moz-animation:    ring-line 2.95s infinite;
	-o-animation:      ring-line 2.95s infinite;
	animation:         ring-line 2.95s infinite;
} 
.editInfo:before{
  background:rgba(242, 166, 20, 0.9);
  border: solid 1px rgba(242, 166, 20, 1);
	position: absolute;
  z-index:-1;
	left: 50%;
	top: 50%;
  margin:-15px 0 0 -15px;
	width: 30px;
	height: 30px;
	content: "";
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-webkit-animation: ring-line 2.90s infinite; 
	-moz-animation:    ring-line 2.90s infinite;
	-o-animation:      ring-line 2.90s infinite;
	animation:         ring-line 2.90s infinite;
} 

/* round outline ===========================*/
@-webkit-keyframes ring-line {
  0%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 1;
  }
  90% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
	opacity: 0;
  }
   100%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 0;
  }
}
@-moz-keyframes  ring-line {
  0%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 1;
  }
  90% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
	opacity: 0;
  }
   100%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 0;
  }
}
@-o-keyframes ring-line {
   0%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 1;
  }
  90% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
	opacity: 0;
  }
   100%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 0;
  }
}
@keyframes  ring-line {
   0%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 1;
  }
  90% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
	opacity: 0;
  }
   100%   { 
	 -webkit-transform: scale(1.2);  
     -ms-transform: scale(1.2); 
     transform: scale(1.2);
	 opacity: 0;
  }
}

/* round animation ===========================*/
@-webkit-keyframes ring-button {
   0%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  10%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  50% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
  }
   100%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
}
@-moz-keyframes  ring-button {
   0%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  10%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  50% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
  }
   100%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
}
@-o-keyframes ring-button {
  0%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  10%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  50% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
  }
   100%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
}
@keyframes  ring-button {
 0%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  10%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
  50% { 
	-webkit-transform: scale(1.4);  
    -ms-transform: scale(1.4); 
    transform: scale(1.4);
  }
   100%   { 
	 -webkit-transform: scale(1);  
     -ms-transform: scale(1); 
     transform: scale(1);
  }
}

/* round outline ===========================*/
@-webkit-keyframes ring-white {
   0%   { 
	 -webkit-transform: scale(1.4);  
     -ms-transform: scale(1.4); 
     transform: scale(1.4);
	 opacity: 1;
  }
  50% { 
	-webkit-transform: scale(1.2);  
    -ms-transform: scale(1.2); 
    transform: scale(1.2);
	opacity: 1;
  }
   80%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 1;
  }
   100%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 0;
  }
}
@-moz-keyframes  ring-white {
  0%   { 
	 -webkit-transform: scale(1.4);  
     -ms-transform: scale(1.4); 
     transform: scale(1.4);
	 opacity: 1;
  }
  50% { 
	-webkit-transform: scale(1.2);  
    -ms-transform: scale(1.2); 
    transform: scale(1.2);
	opacity: 1;
  }
   80%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 1;
  }
   100%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 0;
  }
}
@-o-keyframes ring-white {
 0%   { 
	 -webkit-transform: scale(1.4);  
     -ms-transform: scale(1.4); 
     transform: scale(1.4);
	 opacity: 1;
  }
  50% { 
	-webkit-transform: scale(1.2);  
    -ms-transform: scale(1.2); 
    transform: scale(1.2);
	opacity: 1;
  }
   80%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 1;
  }
   100%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 0;
  }
}
@keyframes  ring-white {
  0%   { 
	 -webkit-transform: scale(1.4);  
     -ms-transform: scale(1.4); 
     transform: scale(1.4);
	 opacity: 1;
  }
  50% { 
	-webkit-transform: scale(1.2);  
    -ms-transform: scale(1.2); 
    transform: scale(1.2);
	opacity: 1;
  }
   80%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 1;
  }
   100%   { 
	 -webkit-transform: scale(0.1);  
     -ms-transform: scale(0.1); 
     transform: scale(0.1);
	 opacity: 0;
  }
}






	@media(max-width: 576px){
	.contacts_card{
		margin-bottom: 15px !important;
	}
	}
    </style>
    @livewireStyles
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    AI Stefancoding 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('chat') }}">
                                       Bubby Boo chat
                                    </a>
                                     <a class="dropdown-item" href="{{ route('my-account') }}">
                                       My Account
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
	{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    @livewireScripts
	
</body>
</html>
