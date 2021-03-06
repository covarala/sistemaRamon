<?php
$tmp = session()->all();
if (!isset($tmp['email'])) {
  $tmp['email']=null;
}
if (!isset($tmp['tipoUsuario'])) {
$tmp['tipoUsuario']=null;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="google-site-verification" content="EmGqWg_a_fJy9kHdv7zJpSM96CnHAjF8wXaL3G8Dn5o" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title', 'Rapadura Mônada')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('imagens\favicon .ico') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  </head>
  <body class="">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d823b;">
      <a class="navbar-brand"style="width:200px" href="{{ asset('inicial') }}"><img src="{{ asset('imagens\logo.png') }}" width="134" height="38" alt="">
    </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse row" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link text-white" href="{{ route('inicial') }}">Inicio<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-white" href="{{ route('produtos') }}">Produtos<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-white" href="{{ route('sobre') }}">Sobre<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-white" href="{{ route('duvidas') }}">Dúvidas<span class="sr-only">(current)</span></a>
          </li>
        </ul>
            <!-- Authentication Links -->
            @if($tmp['email'] === null)
            <ul class="navbar-nav">
              <div class="mb-3 mb-md-0 ml-md-3" style="width:200px">
                <li class="nav-item dropdown ">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <img src="{{ asset('imagens\login.png') }}" width="37" height="37"  alt="" style="float:left; margin:0 10px 10px 0;">
                    Entre ou <br> cadastre-se
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('entrar') }}">{{ __('Entrar') }} <img src="{{ asset('imagens\entrar.png') }}"  class="rounded float-right" ></a>
                    <a class="dropdown-item"  href="{{ route('registrar') }}">{{ __('Registrar') }} <img src="{{ asset('imagens\register.png') }}"  class="rounded float-right" ></a>
                    </div>
                </li>
              </div>
            </ul>
            @else
            <ul class="navbar-nav ml-auto">
            <ul class="navbar-nav">
              <div class="mb-3 mb-md-0 ml-md-3" style="width:200px">
                @if(isset($tmp['tipoUsuario']) && $tmp['tipoUsuario'] === 'admin')
                <li class="nav-item active">
                  <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Voltar ao painel de controle<span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="nav-item dropdown ">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      <img src="{{ asset('imagens\login.png') }}" width="37" height="37"  alt="" style="float:left; margin:0 10px 10px 0;">
                        Olá, {{ $tmp['nome'] }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('perfil.cliente', $tmp['id']) }}">
                            {{ __('Perfil') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
              </div>
            </ul>

            @endif
            @endif
        </ul>


      </div>
    </nav>
    @if(isset($tmp['tipoUsuario']) && ($tmp['tipoUsuario'] === 'admin' || $tmp['tipoUsuario'] === 'distribuidor'))
    <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #fff;">
      @if($tmp['tipoUsuario'] === 'admin')
      <a class="nav-link active text-body" href="#">Orçamentos Recebidos</a>
      @else
      <a class="nav-link active text-body" href="{{route('distribuidor.inicial', $tmp['id'])}}">Orçamentos Recebidos</a>
      @endif
      <a class="nav-link text-body" href="{{route('produtos.distribuidor')}}">Reposição de Produtos</a>
    </nav>
    @endif
      @if (session('status-cadastro'))
      <div class="alert alert-info">
        {{ session('status-cadastro') }}
      </div>
      @endif
    @yield('conteudo')



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>
  </body>
  <footer class="text-muted" >
    <div class="container">
      <p class="text-sm-center">Politica de privacidade <a href="{{route('privacidade')}}">clique aqui</a></p>
      <p class="text-sm-center">Rapadura Mônada: Faz. Itapiraçaba - Local denominado Sto Antônio -
Rod. Januária Brejo do Amparo, 5090 - Zona Rural - Januária / MG – CEP 39.480-000</p>
    </div>


  </footer>
</html>
