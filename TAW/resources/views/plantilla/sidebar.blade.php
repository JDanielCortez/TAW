<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
        <!-- Inicializar la variable menu = 0 que se encuentra en app.js -->
            <li class="nav-item">
                <router-link class="nav-link active" to='/categorias'><i class="icon-speedometer"></i> Escritorio</router-link>
            </li>
            <li class="nav-title">
                Mantenimiento
            </li> 
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Almacén</a>
                <ul class="nav-dropdown-items">
                    <li  class="nav-item">
                        <router-link to="/categorias"class="nav-link" ><i class="icon-bag"></i> Categorías</router-link>
                        <!-- <a class="nav-link" ><i class="icon-bag"></i> Categorías</a> -->
                    </li>
                    <li v-on:click="menu=1" class="nav-item">
                        <router-link to="/articulos"class="nav-link" ><i class="icon-bag"></i> Articulos</router-link>
                        <!-- <a class="nav-link" ><i class="icon-bag"></i> Artículos</a> -->
                    </li>
                </ul>
            </li>
            <li  class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <router-link to='/ingresos' class="nav-link" ><i class="icon-wallet"></i> Ingresos</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to='/proveedores' class="nav-link" ><i class="icon-notebook"></i> Proveedores</router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                <ul class="nav-dropdown-items">
                    <li  class="nav-item">
                        <router-link to='/ventas' class="nav-link" ><i class="icon-basket-loaded"></i> Ventas</router-link>
                    </li>
                    <li  class="nav-item">
                        <router-link to='/clientes' class="nav-link" ><i class="icon-notebook"></i> Clientes</router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                <ul class="nav-dropdown-items">
                    <li v-on:click="menu=6" class="nav-item">
                        <a class="nav-link" ><i class="icon-user"></i> Usuarios</a>
                    </li>
                    <li v-on:click="menu=7" class="nav-item">
                        <a class="nav-link" ><i class="icon-user-following"></i> Roles</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                <ul class="nav-dropdown-items">
                    <li v-on:click="menu=8" class="nav-item">
                        <a class="nav-link" ><i class="icon-chart"></i> Reporte Ingresos</a>
                    </li>
                    <li v-on:click="menu=9" class="nav-item">
                        <a class="nav-link" ><i class="icon-chart"></i> Reporte Ventas</a>
                    </li>
                </ul>
            </li>
            <li v-on:click="menu=10" class="nav-item">
                <a class="nav-link" ><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
            </li>
            <li v-on:click="menu=11" class="nav-item">
                <a class="nav-link" ><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
            </li>
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>