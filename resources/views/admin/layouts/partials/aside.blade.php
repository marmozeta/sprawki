{{ print_r($user_permissions) }}
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
                        @if(in_array('menu', $user_permissions['modify']) || in_array('menu', $user_permissions['remove']))   
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.menu') }}"
                                    aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                        class="hide-menu">Pozycje menu
                                    </span></a>
                            </li>
                        @endif
                        @foreach ($menus as $menu)
                            @if(in_array($menu->slug, $user_permissions['modify']) || in_array($menu->slug, $user_permissions['remove']))
                                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.element', $menu->slug) }}"
                                aria-expanded="false"><i class="{{ ($menu->icon) ? $menu->icon : 'fa fa-list'}}"></i><span
                                    class="hide-menu">{{ $menu->name }}</span></a></li>
                            @endif
                        @endforeach
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Słowniki</span></li>
                        
                        @if(in_array('tagi', $user_permissions['modify']) || in_array('tagi', $user_permissions['remove']))   
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.tag') }}"
                                    aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                        class="hide-menu">Tagi
                                    </span></a>
                            </li>
                        @endif
                        @if(in_array('kategorie', $user_permissions['modify']) || in_array('kategorie', $user_permissions['remove']))   
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.category') }}"
                                    aria-expanded="false"><i data-feather="shopping-cart" class="feather-icon"></i><span
                                        class="hide-menu">Sklep - kategorie
                                    </span></a>
                            </li>
                        @endif
                        <li class="list-divider"></li>
                        @if(in_array('media', $user_permissions['modify']) || in_array('media', $user_permissions['remove']))   
                            <li class="nav-small-cap"><span class="hide-menu">Media</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.media') }}"
                                    aria-expanded="false"><i data-feather="camera" class="feather-icon"></i><span
                                        class="hide-menu">Biblioteka mediów </span></a>
                            </li>
                            <li class="list-divider"></li>
                        @endif
                        <li class="nav-small-cap"><span class="hide-menu">Użytkownicy</span></li>
                        @if(in_array('uzytkownicy', $user_permissions['modify']) || in_array('uzytkownicy', $user_permissions['remove']))                        
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.user') }}"
                                    aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                        class="hide-menu">Lista użytkowników </span></a>
                            </li>
                        @endif
                        @if(in_array('role', $user_permissions['modify']) || in_array('role', $user_permissions['remove']))                        
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.role') }}"
                                    aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                        class="hide-menu">Role </span></a>
                            </li>
                        @endif
                        @if(in_array('komentarze', $user_permissions['modify']) || in_array('komentarze', $user_permissions['remove']))                        
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.comment') }}"
                                    aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                                        class="hide-menu">Komentarze </span></a>
                            </li>
                        @endif
                        <li class="list-divider"></li>
                        @if(in_array('sprzedaz', $user_permissions['modify']) || in_array('sprzedaz', $user_permissions['remove']))                        
                        <li class="nav-small-cap"><span class="hide-menu">Marketing</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.order') }}"
                                    aria-expanded="false"><i data-feather="shopping-bag" class="feather-icon"></i><span
                                        class="hide-menu">Sprzedaż </span></a>
                            </li>
                        <li class="list-divider"></li>
                        @endif
                        @if(in_array('ustawienia', $user_permissions['modify']))                                           
                            <li class="nav-small-cap"><span class="hide-menu">Ustawienia</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.settings.hot') }}"
                                    aria-expanded="false"><i data-feather="coffee" class="feather-icon"></i><span
                                        class="hide-menu">Czy gorący </span></a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>