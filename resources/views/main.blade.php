@extends('layouts.template')

@section('content')
    @include('layouts.nav')  
    <head>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
</head>

<main>
    <section class="section__index--1">

      <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">Variedad de bolsas</h2>
            <br>
            <p class="lead">Screen Boutique cuenta con variedad de bolsas boutique, diferentes tamaños, color, diseño. Esto abre paso a una gran capacidad de personalización a tiendas u/o empresas.</p>
          </div>
          <div class="col-md-5">
            <img class="rounded img-fluid" src="{{ asset('images/index4.png')}}" alt="" width="100%" height="100%">

          </div>  
      </div>

    </section>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">Bueno, Bonito y Barato</h2>
        <br>
        <p class="lead">Como ya se mencionó, buscamos llegar a todas aquellas empresas, negocios, corporaciones y compañias que busquen mejorar su imagen y que mejor forma de hacerlo que poner tu logo en las bolsas de tus productos. Y lo mejor! con precios bajos para todos aquellos que lo quieren intentar.</p>
        </div>
        <div class="col-md-5 order-md-1">
          <img class="rounded img-fluid" src="{{ asset('images/index5.png')}}" alt="" width="100%" height="100%">

        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">¡¡ Lo que merece la imagen de tu negocio !!</h2>
        <br>
        <p class="lead">Screen Boutique se centra la personalización completa de tu imagen corporativa, el cliente tiene a sus disponibilidad la capacidad de realizar cambios de su diseño personalizado, y todo gracias a que, contamos con diseñadores dispuestos a atender y satisfacer los gustos del cliente</p>
        </div>
        <div class="col-md-5">
          <img class="rounded img-fluid" width="500px" height="500px" src="{{ asset('images/index6.jpg')}}" ">
        </div>
    </div>

    <hr class="featurette-divider">

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
    
    </footer>
</main>
@endsection