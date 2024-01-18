<aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Tablica</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Elementy</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.menu') }}"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Pozycje menu
                                </span></a>
                        </li>
                        @foreach ($menus as $menu)
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.element', $menu->slug) }}"
                                aria-expanded="false"><i class="{{ ($menu->icon) ? $menu->icon : 'fa fa-list'}}"></i><span
                                    class="hide-menu">{{ $menu->name }}</span></a></li>
                        @endforeach
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Słowniki</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.tag') }}"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Tagi
                                </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.category') }}"
                                aria-expanded="false"><i data-feather="shopping-cart" class="feather-icon"></i><span
                                    class="hide-menu">Sklep - kategorie
                                </span></a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Media</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.media') }}"
                                aria-expanded="false"><i data-feather="camera" class="feather-icon"></i><span
                                    class="hide-menu">Biblioteka mediów </span></a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Użytkownicy</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.user') }}"
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                    class="hide-menu">Lista użytkowników </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.comment') }}"
                                aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                                    class="hide-menu">Komentarze </span></a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Marketing</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.order') }}"
                                aria-expanded="false"><i data-feather="shopping-bag" class="feather-icon"></i><span
                                    class="hide-menu">Sprzedaż </span></a>
                        </li>
                     
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>