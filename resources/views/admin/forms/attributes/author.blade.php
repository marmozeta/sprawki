<div class="form-group mb-3 col-6">
    <label class="form-label">Autor @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="author" value="{{ old('author', $element->author ?? '') }}" placeholder="" @if($attr->required) required @endif/>
</div>
