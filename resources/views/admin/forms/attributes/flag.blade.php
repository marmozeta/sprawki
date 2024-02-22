<div class="clearfix"></div>
<div class="form-group mb-3 col-3">
    <label class="form-label">Flaga @if($attr->required) * @endif</label>
    <input type="text" class="form-control countries" name="flag" value="{{ old('flag', $element->flag ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>