<div class="sidebar collapsed-sidebar" id="collapsed-sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu-2" class="sidebar-menu sidebar-menu-three">
            <aside id="aside" class="ui-aside">
                <ul class="tab nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="tablinks nav-link {{ Request::is('dashboard', 'chat') ? 'active' : '' }}" href="#home" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-selected="true">
                            <img src="{{ URL::asset('/build/img/icons/menu-icon.svg')}}" alt="Dashboard">
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="tablinks nav-link {{ Request::is('products*', 'categories', 'stocks') ? 'active' : '' }}" href="#product" id="product-tab" data-bs-toggle="tab" data-bs-target="#product" role="tab" aria-selected="false">
                            <img src="{{ URL::asset('/build/img/icons/product.svg')}}" alt="Products">
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="tablinks nav-link {{ Request::is('ventes', 'commandes_envoyees', 'livraisons') ? 'active' : '' }}" href="#sales" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" role="tab" aria-selected="false">
                            <img src="{{ URL::asset('/build/img/icons/sales1.svg')}}" alt="Sales">
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="tablinks nav-link {{ Request::is('achats', 'commande_recues', 'fournisseurs') ? 'active' : '' }}" href="#purchase" id="purchase-tab" data-bs-toggle="tab" data-bs-target="#purchase" role="tab" aria-selected="false">
                            <img src="{{ URL::asset('/build/img/icons/purchase1.svg')}}" alt="Purchases">
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="tablinks nav-link {{ Request::is('clients', 'users', 'roles*') ? 'active' : '' }}" href="#user" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" role="tab" aria-selected="false">
                            <img src="{{ URL::asset('/build/img/icons/users1.svg')}}" alt="Users">
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="tablinks nav-link {{ Request::is('logout') ? 'active' : '' }}" href="#settings" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" role="tab" aria-selected="false">
                            <i data-feather="settings"></i>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="tab-content tab-content-four pt-2">
                <ul class="tab-pane {{ Request::is('dashboard', 'chat') ? 'active' : '' }}" id="home" aria-labelledby="home-tab">
                    <li class="submenu">
                        <a href="javascript:void(0);" class="{{ Request::is('dashboard') ? 'active subdrop' : '' }}"><span>Dashboard</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">Tableau De Bord</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);" class="{{ Request::is('chat') ? 'active subdrop' : '' }}"><span>Application</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('chat') }}" class="{{ Request::is('chat') ? 'active' : '' }}">Messagerie</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="tab-pane {{ Request::is('products*', 'categories', 'stocks') ? 'active' : '' }}" id="product" aria-labelledby="product-tab">
                    <li><a href="{{ route('products.index') }}" class="{{ Request::is('products*') ? 'active' : '' }}"><span>Produits</span></a></li>
                    <li><a href="{{ route('categories.index') }}" class="{{ Request::is('categories') ? 'active' : '' }}"><span>Catégories</span></a></li>
                    <li><a href="{{ route('stocks.index') }}" class="{{ Request::is('stocks') ? 'active' : '' }}"><span>Stocks</span></a></li>
                </ul>
                <ul class="tab-pane {{ Request::is('ventes', 'commandes_envoyees', 'livraisons') ? 'active' : '' }}" id="sales" aria-labelledby="sales-tab">
                    <li><a href="{{ url('ventes') }}" class="{{ Request::is('ventes') ? 'active' : '' }}"><span>Ventes</span></a></li>
                    <li><a href="{{ url('commandes_envoyees') }}" class="{{ Request::is('commandes_envoyees*') ? 'active' : '' }}"><span>Commandes Envoyées</span></a></li>
                    <li><a href="{{ route('livraisons.index') }}" class="{{ Request::routeIs('livraisons.index') ? 'active' : '' }}"><span>Livraisons</span></a></li>
                </ul>
                <ul class="tab-pane {{ Request::is('achats', 'commande_recues', 'fournisseurs') ? 'active' : '' }}" id="purchase" aria-labelledby="purchase-tab">
                    <li><a href="{{ route('achats.index') }}" class="{{ Request::is('achats') ? 'active' : '' }}"><span>Achats</span></a></li>
                    <li><a href="{{ url('commande_recues') }}" class="{{ Request::is('commande_recues') ? 'active' : '' }}"><span>Commandes Reçues</span></a></li>
                    <li><a href="{{ url('fournisseurs') }}" class="{{ Request::is('fournisseurs', 'add-fournisseur', 'edit-fournisseur', 'show-fournisseur') ? 'active' : '' }}"><span>Fournisseurs</span></a></li>
                </ul>
                <ul class="tab-pane {{ Request::is('clients', 'users', 'roles*') ? 'active' : '' }}" id="user" aria-labelledby="user-tab">
                    <li><a href="{{ route('clients.index') }}" class="{{ Request::is('clients*') ? 'active' : '' }}"><span>Clients</span></a></li>
                    <li><a href="{{ url('users') }}" class="{{ Request::is('users') ? 'active' : '' }}"><span>Employées</span></a></li>
                    <li><a href="{{ url('roles') }}" class="{{ Request::is('roles*') ? 'active' : '' }}"><span>Rôles</span></a></li>
                </ul>
                <ul class="tab-pane {{ Request::is('logout') ? 'active' : '' }}" id="settings" aria-labelledby="settings-tab">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background: none; border: none; padding: 0; margin: 0; color: inherit; cursor: pointer;">
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>