<div class="form-group mb-3">
    <label class="form-label">Obrazek @if($attr->required) * @endif</label>
    <main class="page row">
	<!-- input file -->
	<div class="box col-12 mb-3">
		<input type="file" id="file-input"/>
                <input type="hidden" name="image" value="{{ old('image', $element->image ?? '') }}" />
	</div>
	<!-- leftbox -->
	<div class="box-2 col-4">
		<div class="result"></div>
	</div>
	<!--rightbox-->
	<div class="box-2 img-result {{(!isset($element->image))?'d-none':''}} col-4">
		<!-- result of crop -->
		<img class="cropped" src="/public/images/elements/{{ old('image', $element->image ?? '') }}" alt="">
                @if(isset($element->image))
                <a href='#' onClick="$(this).parent().find('.cropped').attr('src', '');$(this).remove();$('input[name=\'image\']').val('');"><i class="fa fa-remove"></i></a>
                @endif
	</div>
	<!-- input file -->
	<div class="box">
		<div class="options d-none">
		</div>
		<!-- save btn -->
		<button class="btn save d-none">Przytnij zdjęcie</button>
	</div>
</main>
</div>
