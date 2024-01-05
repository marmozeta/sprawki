<div class="form-group mb-3 col-6">
    <label class="form-label">Ilość w magazynie @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="stock_quantity" value="{{ old('stock_quantity', $element->stock_quantity ?? '') }}" placeholder="" @if($attr->required) required @endif/>
</div>
