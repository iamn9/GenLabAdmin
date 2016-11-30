@extends('scaffold-interface.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">You are logged in!</div>
            </div>

             <style>
            html, body {
                background-color: #fff;
                background-image: url("/img/bghome.jpg");
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 90vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: fixed;
                left: 30%;
                top: 0%;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

            <body>
                <form>
                    <div class="flex-center position-ref full-height">
                        <div class="content">
                        <img src="/img/upicon.png" style="width:128px;height:128px;">
                        <img src="/img/intersoc.png" style="width:109px;height:128px">
                            <div class="title m-b-md">
                                 GenLab System
                            </div>
                            <div class="links">
                            <input class="account" type="button" value="ACCOUNTABILITIES" onclick="window.location.href='http://facebook.com'"/>
                            <input class="borrow" type="button" value="BORROW" onclick="window.location.href='/borrow'" />
                        </div>
                    </div>
                </form>
            </body> 
        </div>
    </div>
</div>
@endsection
