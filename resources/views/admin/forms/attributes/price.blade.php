<div class="form-group mb-3 col-6">
    <label class="form-label">Cena brutto @if($attr->required) * @endif</label>
    <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $element->price ?? '') }}" placeholder="" @if($attr->required) required @endif/>
</div>
