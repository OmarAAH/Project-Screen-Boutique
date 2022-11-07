@extends('layouts.template-inicio')

@section('content')
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand">Screen Boutique</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>

                <!--Aqui tiene que colocar los enlaces-->
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{route('catalogue')}}">Catalogo</a></li>
                        <li class="nav-item"><a class="btn btn-light btn-sesion" href="{{route('login')}}">Iniciar Sesión</a></li>
                    </ul>
                </div>

            </div>
        </nav>
       
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Conoce nuestros productos</div>
                <div class="masthead-heading text-uppercase">¡Visita nuestro catalogo!</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Screen Boutique</a>
            </div>
        </header>
    
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h1 class="section-heading text-uppercase">Sobre nosotros</h1>
                    <p class="section-subheading text-info text-muted">Somos una pequeña empresa especializada en la serigrafia, o siendo mas especificos trabajamos con bolsas plasticas tipo boutique y bolsas de papel, estampamos tu logo personalizado de tu empresa, tienda o emprendimiento. Nuestra misión, es ayudar a todos aquellos pequeños emprendedores a expandirse y plasmar la imagen de tu empresa en bolsas. Y, todo esto gracias a los precios accesibles que manejamos. Contactanos y obten mas información</p>
                </div>
                <div class="row text-center">

                    <hr class="featurette-divider">
                    
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>

                        <img class="bd-placeholder-img rounded-circle" src="{{ asset('images/assets/vision.webp')}}" role="img" width="140" height="140">

                        <h4 class="my-3">Visión</h4>
                        <p class="text-muted">Fue fundada con la finalidad de ayudar a emprender a pequeños negocios. Y a su vez, ayudando a las grandes empresas del mercado. Satifacer de manera eficiente a los clientes.</p>
                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>

                        <img class="bd-placeholder-img rounded-circle" src="{{ asset('images/assets/mision.webp')}}" role="img" width="140" height="140">

                        <h4 class="my-3">Misión</h4>
                        <p class="text-muted">Impulsar de manera eficaz a las pequeñas empresas que quieran invertir en su imagen, y todo esto gracias a precios totalmente accesibles para esos pequeños negocios.</p>
                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>

                        <img class="bd-placeholder-img rounded-circle" src="{{ asset('images/assets/meta.webp')}}" role="img" width="140" height="140">

                        <h4 class="my-3">Meta</h4>
                        <p class="text-muted">El objetivo a lograr es, el reconocimiento a nivel nacional como una empresa de confianza, segura y de calidad. Esto se logrará gracias al apoyo de los clientes que fecuentan y apoyan al crecimiento de la misma.</p>
                    </div>

                </div>
            </div>
        </section>

        <section class="page-section">
            <div class="container">
                <div class="text-center">
                    <h1 class="section-heading text-uppercase">Formas de Contacto</h1>
                    <p class="section-subheading text-muted">No olvides contactarnos y resolveremos cualquier duda que tengas</p>
                </div>
                <div class="row text-center">

                    <hr class="featurette-divider">
                    
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <a href="https://www.instagram.com/screenboutique/">
                            <img class="bd-placeholder-img rounded-circle" src="{{ asset('images/assets//img/contact/ig.png')}}" role="img" width="140" height="140" target="_blank">
                        </a>
                            <h4 class="my-3">Instagram</h4>
                        <p class="text-muted">Contactanos atraves de la red social instagram, ahí te atendera un asesor</p>
                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>


                        <h4 class="my-3"></h4>
                        <p class="text-muted"></p>
                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>

                        <a href="https://api.whatsapp.com/send?phone=584247427244&text=%20">
                            <img class="bd-placeholder-img rounded-circle" src="{{ asset('images/assets/img/contact/wp.png')}}" role="img" width="140" height="140">
                        </a>
                        
                        <h4 class="my-3">WhatsApp</h4>
                        <p class="text-muted">Con WhatsApp, te atendera directamente el departamento de ventas</p>
                    </div>
            </div>
        </section>
       
        
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright perteneciente al equipo numero 13°</div>
                </div>
            </div>
        </footer>
      
@endsection
