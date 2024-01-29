<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu <i class="icon-cross" style="color: #cb1d24;"></i> </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="index.html"><img src="../sprawki.png" width="100"/></a></h1><br/><br/>
		<ul style="margin-top: 55px;">
		<li><hr/></li>
		<li>
		<i class="icon-calendar" style="color: #cb1d24;"></i>&nbsp;&nbsp;Dziś jest środa, 4.10.2023
		</li>
		<li>
		<i class="icon-user" style="color: #cb1d24;"></i>&nbsp;&nbsp;Patron dnia: <span style="color: #cb1d24;">św. Franciszek</span>
		</li>
		<li><hr/></li>
			<li class="active"><a href="index.html" style="color: #cb1d24 !important;font-size: 1.1em; letter-spacing: 1.5px; font-weight: 400;">Sprawki</a></li>
			<li><a href="about.html" style="font-size: 1.1em; letter-spacing: 1.5px; font-weight: 300;">Rozprawki</a></li>
			<li><a href="pricing.html" style="font-size: 1.1em; letter-spacing: 1.5px; font-weight: 300;">Polecane</a></li>
			<li><a href="contact.html" style="font-size: 1.1em; letter-spacing: 1.5px; font-weight: 300;">Społeczność</a></li>
			<li><a href="contact.html" style="font-size: 1.1em; letter-spacing: 1.5px; font-weight: 300;">Mój profil</a></li>
		</ul>
		<h3 class="fh5co-lead">Zobacz nas na</h3>
		<p class="fh5co-social-icons">
			<a href="#" style="color: #cb1d24;"><i class="icon-twitter"></i></a>
			<a href="#" style="color: #cb1d24;"><i class="icon-facebook"></i></a>
			<a href="#" style="color: #cb1d24;"><i class="icon-instagram"></i></a>
			<a href="#" style="color: #cb1d24;"><i class="icon-dribbble"></i></a>
			<a href="#" style="color: #cb1d24;"><i class="icon-youtube"></i></a>
		</p>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row" style="display: flex; align-items: center;">
                            <div class="col-md-9">
                                <ul class="navbar menu">
                                    @foreach($menus_front as $menu)
                                    <li><a class="{{ ($menu->slug==request()->path()) ? 'active' : ''}}" href="/{{ $menu->slug }}"><span>{{ substr($menu->name, 0, 1) }}</span>{{ substr($menu->name, 1) }}</a></li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                            <div class="col-md-3">
					<!--<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn" style="background: #cc1d23; padding: 2px 5px; border-radius: 2px;">Menu <i class="fa fa-bars"></i></a>-->
					
                                        <a href="#" class="fh5co-menu-btn" style="margin-right: 14px;"><i class="fa fa-search"></i></a>
					@if(Auth::check())
                                            <a href="{{ route('admin.dashboard') }}" class="fh5co-menu-btn" style="margin-right: 7px;"><i class="fa fa-user"></i></a>
                                        @else
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="fh5co-menu-btn" style="margin-right: 7px;"><i class="fa fa-user"></i></a>
                                        @endif
                                        <a href="{{ route('front.cart') }}" id="cart" data-totalitems="{{ Cart::count() }}" class="cart fh5co-menu-btn" style="margin-right: 7px;"><i class="fa fa-shopping-cart"></i></a> 
                                        <div id="to-cart"><i class="fa-solid fa-box"></i></div>   
                            </div>
                            
			</div>
		</div>
	</header>
	<!-- END .header -->