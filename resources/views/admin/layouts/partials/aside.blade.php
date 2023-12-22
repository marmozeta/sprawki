<aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('admin.dashboard') }}"
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
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('admin.element', $menu->slug) }}"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">{{ $menu->name }}</span></a></li>
                        @endforeach
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Słowniki</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.category') }}"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Kategorie
                                </span></a>
                        </li>
                        <!--<li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.type') }}"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Typy
                                </span></a>
                        </li>-->
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Użytkownicy</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="#"
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                    class="hide-menu">Lista użytkowników </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="#"
                                aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                                    class="hide-menu">Komentarze </span></a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Marketing</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="#"
                                aria-expanded="false"><i data-feather="shopping-bag" class="feather-icon"></i><span
                                    class="hide-menu">Sprzedaż </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="#"
                                aria-expanded="false"><i data-feather="globe" class="feather-icon"></i><span
                                    class="hide-menu">Reklamy </span></a>
                        </li>
                     
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>