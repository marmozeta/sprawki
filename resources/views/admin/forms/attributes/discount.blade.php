<div class="form-group mb-3 col-6">
    <label class="form-label">Rabat (%)</label>
    <input type="number" class="form-control" name="discount" value="{{ old('discount', $element->discount ?? '') }}" placeholder="" @if($attr->required) required @endif/>
</div>
