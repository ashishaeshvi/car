<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Globe Travels</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/my-css.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css">

    <style>
        .fade:not(.show) {
            opacity: 1;
        }

        .bg-pattern-style {
            background: url('images/under-development.png') no-repeat;
            background-position: center;
            background-size: cover;
            width: 100%;
            height: 100vh;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            opacity: 1;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        #loader {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        #loader::after {
            content: '';
            width: 60px;
            height: 60px;
            display: block;
            position: absolute;
            left: calc(50% - 30px);
            top: calc(50% - 30px);
            border: 5px solid #f5f5f5;
            border-radius: 50%;
            border-top: 5px solid #e1306c;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .account-pages {
            width: 100%;
            max-width: 450px;
        }

        .card {
            border-radius: 15px !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
            overflow: hidden !important;
        }
    </style>
</head>


<body class="authentication-bg authentication-bg-pattern bg-pattern-style">
    <div class="account-pages ">
        <div class="card p-0">
            <div class="card-body p-0">
                <div class="bg-success text-center p-3">
                    <a class="text-white" href="{{ url('login') }}">
                        <h4 class="mb-0 pb-0"><strong>Enter For Login</strong></h4>
                    </a>
                </div>
            </div> <!-- end card-body -->
        </div>
    </div>

</body>

</html>