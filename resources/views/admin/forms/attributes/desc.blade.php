<div class="form-group mb-3">
    <label class="form-label">Opis @if($attr->required) * @endif</label>
    <textarea class="form-control " name="desc" style="width: 1180px; height: 200px;" @if($attr->required)  @endif >{{ old('description', $element->description ?? '') }}</textarea>
</div>
