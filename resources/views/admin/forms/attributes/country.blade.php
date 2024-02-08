<div class="form-group mb-3 col-6 country-fieldset">
    <label class="form-label">Kraj @if($attr->required) * @endif</label>
    <textarea class="form-control" name="country" id="country" style="width: 1180px; height: 24px;" placeholder="" @if($attr->required) required @endif>{{ old('country', $element->country ?? '') }}</textarea>
</div>
