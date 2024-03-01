<div class="form-group mb-3">
    <label class="form-label">Tytuł góra @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="toptitle" value="{{ old('toptitle', $element->toptitle ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>
