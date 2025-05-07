<div class="sidebar horizontal-sidebar">
    <div id="sidebar-menu-3" class="sidebar-menu">
        <ul class="nav">
            <li class="submenu">
                <a href="{{ url('dashboard') }}"
                    class="{{ Request::is('dashboard', 'chat') ? 'active subdrop' : '' }}"><i data-feather="grid"></i><span>Menu Principal</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li class="submenu">
                        <a href="javascript:void(0);"
                            class="{{ Request::is('dashboard') ? 'active subdrop' : '' }}"><span>Tableau de bord</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">Tableau de bord</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"
                            class="{{ Request::is('chat') ? 'active subdrop' : '' }}"><span>Application</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('chat') }}" class="{{ Request::is('chat') ? 'active' : '' }}">Messagerie</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="submenu">
                <a href="javascript:void(0);"
                    class="{{ Request::is('products*', 'categories', 'stocks') ? 'active subdrop' : '' }}"><img src="{{ URL::asset('/build/img/icons/product.svg')}}" alt="img"><span>Inventaire</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li><a href="{{ route('products.index') }}" class="{{ Request::is('products*') ? 'active' : '' }}"><span>Produits</span></a></li>
                    <li><a href="{{ route('categories.index') }}" class="{{ Request::is('categories') ? 'active' : '' }}"><span>Catégories</span></a></li>
                    <li><a href="{{ route('stocks.index') }}" class="{{ Request::is('stocks') ? 'active' : '' }}"><span>Stocks</span></a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="javascript:void(0);"
                    class="{{ Request::is('ventes', 'commandes_envoyees', 'livraisons', 'achats', 'commande_recues', 'fournisseurs') ? 'active subdrop' : '' }}"><img src="{{ URL::asset('/build/img/icons/purchase1.svg')}}" alt="img"><span>Ventes & Achats</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li class="submenu">
                        <a href="javascript:void(0);"
                            class="{{ Request::is('ventes', 'commandes_envoyees', 'livraisons') ? 'active subdrop' : '' }}"><span>Ventes</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('ventes') }}" class="{{ Request::is('ventes') ? 'active' : '' }}"><span>Ventes</span></a></li>
                            <li><a href="{{ url('commandes_envoyees') }}" class="{{ Request::is('commandes_envoyees*') ? 'active' : '' }}"><span>Commandes envoyées</span></a></li>
                            <li><a href="{{ route('livraisons.index') }}" class="{{ Request::routeIs('livraisons.index') ? 'active' : '' }}"><span>Livraisons</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"
                            class="{{ Request::is('achats', 'commande_recues', 'fournisseurs') ? 'active subdrop' : '' }}"><span>Achats</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('achats.index') }}" class="{{ Request::is('achats') ? 'active' : '' }}"><span>Achats</span></a></li>
                            <li><a href="{{ url('commande_recues') }}" class="{{ Request::is('commande_recues') ? 'active' : '' }}"><span>Commandes reçues</span></a></li>
                            <li><a href="{{ url('fournisseurs') }}" class="{{ Request::is('fournisseurs', 'add-fournisseur', 'edit-fournisseur', 'show-fournisseur') ? 'active' : '' }}"><span>Fournisseurs</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="submenu">
                <a href="javascript:void(0);"
                    class="{{ Request::is('clients', 'users', 'roles*') ? 'active subdrop' : '' }}"><i data-feather="users"></i><span>Utilisateurs</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li><a href="{{ route('clients.index') }}" class="{{ Request::is('clients*') ? 'active' : '' }}"><span>Clients</span></a></li>
                    <li><a href="{{ url('users') }}" class="{{ Request::is('users') ? 'active' : '' }}"><span>Employés</span></a></li>
                    <li><a href="{{ url('roles') }}" class="{{ Request::is('roles*') ? 'active' : '' }}"><span>Rôles</span></a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="javascript:void(0);"
                    class="{{ Request::is('logout') ? 'active subdrop' : '' }}"><i data-feather="settings"></i><span>Paramètres</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background: none; border: none; padding: 0; margin: 0; color: inherit; cursor: pointer;">
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
