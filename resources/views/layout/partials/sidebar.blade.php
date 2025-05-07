<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Menu Principale</h6>
                    <ul>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ url('dashboard') }}">
                                <i data-feather="grid"></i><span>Tableau De Bord</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('chat') ? 'active' : '' }}">
                            <a href="{{ url('chat') }}">
                                <i data-feather="message-square"></i><span>Messagerie</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <ul>
                        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                            <a href="{{ url('roles') }}">
                                <i data-feather="shield"></i><span>Rôles</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('users') ? 'active' : '' }}">
                            <a href="{{ url('users') }}">
                                <i data-feather="user-check"></i><span>Employées</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('categories') ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i data-feather="codepen"></i><span>Catégories</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('products*') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i data-feather="box"></i><span>Produits</span>
                            </a>
                        </li>
   <li class="{{ Request::is('stocks') ? 'active' : '' }}">
                            <a href="{{ route('stocks.index') }}">
                                <i data-feather="package"></i><span>Stocks</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('fournisseurs', 'add-fournisseur', 'edit-fournisseur', 'show-fournisseur') ? 'active' : '' }}">
                            <a href="{{ url('fournisseurs') }}">
                                <i data-feather="truck"></i><span>Fournisseurs</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('achats') ? 'active' : '' }}">
                            <a href="{{ route('achats.index') }}">
                                <i data-feather="shopping-cart"></i><span>Achats</span>
                            </a>
                        </li>
                         <li class="{{ Request::is('commande_recues') ? 'active' : '' }}">
                            <a href="{{ url('commande_recues') }}">
                                <i data-feather="codesandbox"></i><span>Commandes Reçues</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('clients*') ? 'active' : '' }}">
                            <a href="{{ route('clients.index') }}">
                                <i data-feather="users"></i><span>Clients</span>
                            </a>
                        </li>
                       
                     
                        <li class="{{ Request::is('ventes') ? 'active' : '' }}">
                            <a href="{{ url('ventes') }}">
                                <i data-feather="shopping-cart"></i><span>Ventes</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('commandes_envoyees*') ? 'active' : '' }}">
                            <a href="{{ url('commandes_envoyees') }}">
                                <i data-feather="box"></i><span>Commandes Envoyées</span>
                            </a>
                        </li>
                        <li class="{{ Request::routeIs('livraisons.index') ? 'active' : '' }}">
                            <a href="{{ route('livraisons.index') }}">
                                <i data-feather="truck"></i><span>Livraisons</span>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    style="background: none; border: none; padding: 0; margin: 0; color: inherit; cursor: pointer;">
                                    <i data-feather="log-out"></i><span>Déconnexion</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

