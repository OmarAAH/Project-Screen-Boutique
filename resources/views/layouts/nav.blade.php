<nav class="navbar navbar-light bg-light fixed-top nav__border--color">
    <div class="container-fluid">

        <button class="navbar-toggler nav__boton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <h5 class="navbar-brand">
            {{auth()->user()->employee->first_name}}
            <img src="{{asset(auth()->user()->employee->photo)}}" alt="" width="40" height="40" class="img-radius">
        </h5>

      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        
        <div class="offcanvas-header slidebar__background--color text-light">

            <a href="{{route('main')}}">
                <img src="{{ asset('images/logo.png')}}" alt="" width="70" height="70">
            </a>

            <div>
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Screen Boutique</h5>
                <p class="text-center"> Rol de {{auth()->user()->role->role}}</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body d-flex">
            <ul class="navbar-nav p-2 flex-grow-1">           
                @switch(auth()->user()->role_id)
                    @case(1)
                    {{-- USUARIOS ADMINISTRADORES --}}
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('employee.show')}}" >Empleados</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('employee.create')}}">Registrar Empleados</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('client.show')}}">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('client.create')}}">Registrar Clientes</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('designer.show')}}">Diseñadores</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('design.show')}}">Diseños</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('inventory.show')}}">Inventario</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('inventory.create')}}">Registrar Producto</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('sales.show')}}">Ventas</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('report.audits')}}" target="_blank">Auditoria</a></li>
                        @break
                    @case(2)
                    {{-- USUARIOS DE INVENTARIO --}}
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('employee-inventory.show')}}">Inventario</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('employee-inventory.create')}}">Registrar Producto</a></li>
                        @break
                    @case(3)
                    {{-- USUARIOS DE VENTAS --}}
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('vendor-sales.show')}}">Ventas</a></li>  
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('vendor-inventory.show')}}">Inventario</a></li>
                        <li class="nav-item"><a class="nav-link nav__link--hover" href="{{route('vendor-design.show')}}">Diseños</a></li>
                        @break      
                @endswitch
            </ul>
        </div>

        <div class="offcanvas-footer">
            <form method="POST" action="{{route('logout')}}">
                @csrf

                <div class="d-grid justify-content-center">
                    <button class="btn btn__logout" type="submit">Cerrar Sesión</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</nav>

