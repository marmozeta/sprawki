<div class="form-group mb-3">
    <label class="form-label">Tytuł @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="title" value="{{ old('title', $element->title ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>
