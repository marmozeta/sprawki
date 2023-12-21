<div class="form-group mb-3">
    <label class="form-label">Autor</label>
    <input type="text" class="form-control" name="author" value="{{ old('author', $element->author ?? '') }}" placeholder="" @if($attr->required) required @endif/>
</div>
