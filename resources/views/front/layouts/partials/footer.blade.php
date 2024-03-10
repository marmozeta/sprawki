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
		<div class="container px-3">
<script>var fmFCFvfbasupwq5=function(e){if(e.data.type==='resize'){document.getElementById('fm-fc-f-vfbasupwq5').style.minHeight=e.data.size+'px'}};window.addEventListener?addEventListener('message',fmFCFvfbasupwq5,!1):attachEvent('onmessage',fmFCFvfbasupwq5);
</script><iframe id="fm-fc-f-vfbasupwq5" data-height="418" src="https://forms.freshmail.io/f/i3yfv21gaf/vfbasupwq5/index.html" frameborder="0" marginheight="0" marginwidth="0" width="100%" style="min-height: 448px"></iframe>
</div>
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