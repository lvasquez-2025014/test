<!-- Sidebar Suite CRM -->
<aside class="app-sidebar">
    <nav class="sidebar-nav">
        @if(request()->routeIs('instancias.show') && isset($instancia) && is_object($instancia) && isset($instancia->id))
            @if(Auth::user()?->isAdmin())
                <a href="{{ route('instancias.index') }}" class="nav-item" title="Volver al Hub de Instancias">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <span>Instancias</span>
                </a>
                <div class="nav-divider"></div>
            @endif

            <a href="#dashboard" class="nav-item sidebar-tab-link" data-nav="dashboard" title="Dashboard y Estadísticas">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>

            <a href="#pipeline" class="nav-item sidebar-tab-link active" data-nav="pipeline" title="Embudo Digital (Leads)">
                <i class="fas fa-columns"></i>
                <span>Embudo</span>
            </a>

            <a href="#chats" class="nav-item sidebar-tab-link" data-nav="chats" title="Bandeja de Entrada Omnicanal">
                <i class="fab fa-whatsapp"></i>
                <span>Chats</span>
            </a>

            <a href="#tareas" class="nav-item sidebar-tab-link" data-nav="tareas" title="Calendario y Tareas To-Do">
                <i class="fas fa-calendar-check"></i>
                <span>Tareas</span>
            </a>

            <a href="#listas" class="nav-item sidebar-tab-link" data-nav="listas" title="Contactos, Catálogo y Difusión">
                <i class="fas fa-address-book"></i>
                <span>Listas</span>
            </a>

            @if(Auth::user()?->isAdmin())
                <div class="nav-divider"></div>

                <a href="#nodos" class="nav-item sidebar-tab-link" data-nav="nodos" title="Constructor Visual de Flujos">
                    <i class="fas fa-project-diagram"></i>
                    <span>Flujos</span>
                </a>

                <a href="#prompt" class="nav-item sidebar-tab-link" data-nav="prompt" title="Entrenamiento e Instrucciones IA">
                    <i class="fas fa-robot"></i>
                    <span>Agente IA</span>
                </a>

                <a href="#modalConfigTecnica" class="nav-item" data-toggle="modal" title="Credenciales Meta y Usuarios de Empresa"> 
                    <i class="fa-solid fa-gear"></i>
                    <span>Ajustes</span>
                </a>
            @endif
        @else
            <a href="{{ route('instancias.index') }}" class="nav-item {{ request()->routeIs('instancias.index') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span>Instancias</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-user">
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0,1)) }}
        </div>
        <div class="user-info">
            <span class="user-name">{{ Auth::user()->name ?? "Usuario" }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="d-inline ml-auto">
            @csrf
            <button type="submit" class="btn-logout" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</aside>
