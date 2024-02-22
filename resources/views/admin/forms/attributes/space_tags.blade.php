<div class="form-group mb-3">
    <label class="form-label">Przestrzeń @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="space_tags" value="{{ old('space_tags', $element->space_tags ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>