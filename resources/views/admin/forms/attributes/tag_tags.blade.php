<div class="form-group mb-3">
    <label class="form-label">Tagi @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="tag_tags" value="{{ old('tag_tags', $element->tag_tags ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>