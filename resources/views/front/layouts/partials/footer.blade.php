@if(!Auth::check())
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content modal-filled">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">LOGOWANIE</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              @include('front.auth.login')    
          </div>
        </div>
      </div>
    </div>
@endif
<footer id="fh5co-footer">
		
		<div class="container">
			<div class="row row-padded">
				<div class="col-md-12 text-center">
					<p class="fh5co-social-icons">
						<a href="#" style="color: #cb1d24;"><i class="fa-brands fa-twitter"></i></i></a>
						<a href="#" style="color: #cb1d24;"><i class="fa-brands fa-facebook"></i></a>
						<a href="#" style="color: #cb1d24;"><i class="fa-brands fa-instagram"></i></a>
						<a href="#" style="color: #cb1d24;"><i class="fa-brands fa-dribbble"></i></a>
						<a href="#" style="color: #cb1d24;"><i class="fa-brands fa-youtube"></i></a>
					</p>
					<p><small>&copy; 2023 Sprawki.pl | Designed by: <a href="http://freehtml5.co/" target="_blank" style="color: #cb1d24;">j7technologies</a> </small></p>
				</div>
			</div>
		</div>
	</footer>