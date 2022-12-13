<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Sistema de Control de Personal Contradado">
        <meta name="author" content="JMMK">
        <meta name="keywords" content="Sistema de Control de Personal Contratado">

        <title>Iniciar Sesion</title>

        <!-- Fontfaces CSS-->
        <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" media="all">
        
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="escritorio">
                @yield('label1')
                </div>
            </div>
        @yield('label2')
        </div>

        <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    </body>
</html>