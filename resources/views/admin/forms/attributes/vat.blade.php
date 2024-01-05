<div class="form-group mb-3 col-6">
    <label class="form-label">Podatek VAT (%) @if($attr->required) * @endif</label>
    <input type="number" class="form-control" name="vat" value="{{ old('vat', $element->vat ?? '') }}" placeholder="" @if($attr->required) required @endif/>
</div>
