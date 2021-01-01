<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-control" content="public">
    <meta name="description" content=""/>
    <meta name="author" content="Timake">
    <meta name="title" content="@yield('title')">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="https://www.timake.com.br" />
    <meta property="og:site_name" content="Timake" />

    <link rel="canonical" href="https://www.timake.com.br">
    <link rel="icon" href="favicon.png"/>

    <title>Timake - @yield('title')</title>

  </head>
  
  <style>

    <?php
      include('css/crud.css');
    ?>

  </style>

  <body>

    <section id="loading" class="justify-content-center align-items-center">
      <div class="loader"></div>
    </section>

    <!--@yeld usado para exibir o conteudo do content vindo de cada página-->
    @yield('content')

  </body>

</html>

<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">

<script src="js/jquery.min.js"></script>
<script src="js/crud.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

    //Token Laravel
    $.ajaxSetup({
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        }
    }); 
  
</script>