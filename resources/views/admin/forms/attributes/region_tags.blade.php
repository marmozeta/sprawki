<div class="form-group mb-3">
    <label class="form-label">Region @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="region_tags" value="{{ old('region_tags', $element->region_tags ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>