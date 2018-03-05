<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#3c8dbc"/>
        <title>GenLab System</title>
        <!-- Styles -->
        <style>
            @font-face {
            font-family: 'Raleway';
            font-style: thin;
            src: url("../fonts/raleway/Raleway-Thin.woff2") format('woff2');
            }
        
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #000000;
                padding: 0 25px;
                font-family: 'Raleway', sans-serif;
                font-weight: bold;
                font-size: 12px;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
        <link rel="manifest" href="manifest.json">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div style="text-align: center;">
            <img src="/img/upicon.png" style="width:128px;height:128px;">
            <img src="/img/intersoc.png" style="width:109px;height:128px">
                <div style="margin-bottom: 30px; font-size: 84px;">
                    GenLab System
                </div>
                @if( Session::has( 'success' ))
                   <div style="color: green"><b>{{ Session::get( 'success' ) }}</b></div><br>
                @elseif( Session::has( 'error' ))
                    <div style="color: red"><b>{{ Session::get( 'error' ) }}</b></div><br>
                @elseif( Session::has( 'warning' ))
                    <div style="color: yellow"><b>{{ Session::get( 'warning' ) }}</b></div><br>
                @elseif( Session::has( 'info' ))
                    <div style="color: blue"><b>{{ Session::get( 'info' ) }}</b></div><br>
                @endif
                <div class="links">
                    @if (Route::has('login'))
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                    <a href="/about">About</a>
                </div>
            </div>
        </div>
    </body>
    <script>
        if ('serviceWorker' in navigator) {
            console.log("Will the service worker register?");
            navigator.serviceWorker.register('service-worker.js')
            .then(function(reg){
                console.log("Yes, it did.");
            }).catch(function(err) {
                console.log("No it didn't. This happened: ", err)
            });
        }
    </script>
</html>
