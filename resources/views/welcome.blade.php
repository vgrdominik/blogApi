<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reserva de tareas para el desarrollador Valentí Gàmez</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ config('ctic.spa_website') }}">Home</a>
                    @else
                        <a href="{{ config('ctic.spa_website') . '/login' }}">Login</a>
                         |
                        <a href="{{ config('ctic.spa_website') . '/registro' }}">Registro gratuito</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Reserva de tareas para el desarrollador Valentí Gàmez
                </div>

                <div class="links">
                    <a href="https://valentigamez.com">Web personal</a>
                    <a href="https://www.facebook.com/iamvalentigamez">Facebook</a>
                    <a href="https://twitter.com/iamvalentigamez">Twitter</a>
                    <a href="https://www.instagram.com/iamvalentigamez/">Instagram</a>
                    <a href="https://www.linkedin.com/in/valent%C3%AD-g%C3%A0mez-rojas-5919b073/">Linkedin</a>
                    <a href="https://www.youtube.com/vgrdominik">Youtube</a>
                </div>
            </div>
        </div>
    </body>
</html>
