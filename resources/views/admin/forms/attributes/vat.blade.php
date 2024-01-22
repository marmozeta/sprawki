<div class="form-group mb-3 col-6">
    <label class="form-label">Podatek VAT (%) @if($attr->required) * @endif</label>
    <select class="form-control" name="vat" @if($attr->required) required @endif>
        <option value="23" {{ (old('vat', $element->vat ?? '')==23)?'selected':'' }}>23%</option>
        <option value="8" {{ (old('vat', $element->vat ?? '')==8)?'selected':'' }}>8%</option>
        <option value="0" {{ (old('vat', $element->vat ?? '')==0)?'selected':'' }}>0%</option>
    </select>
</div>
