<div class="form-group mb-3">
    <label class="form-label">Zajawka @if($attr->required) * @endif</label>
    <textarea class="form-control" name="teaser" style="width: 1180px; height: 100px;" maxlength="600" @if($attr->required) required @endif>{{ old('teaser', $element->teaser ?? '') }}</textarea>
</div>
