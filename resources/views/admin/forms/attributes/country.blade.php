<div class="form-group mb-3 col-6 country-fieldset">
    <label class="form-label">Kraj @if($attr->required) * @endif</label>
    <input type=text" class="form-control" name="country" id="country" placeholder="" @if($attr->required) required @endif value="{{ old('country', $element->country ?? '') }}" />
</div>
