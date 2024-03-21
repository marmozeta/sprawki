<div class="form-group mb-3">
    <label class="form-label">Szerokość reklamy @if($attr->required) * @endif</label>
    <select class="form-control" name="ad_weight" @if($attr->required) required @endif>
        <option {{ (old('ad_weight', $element->ad_weight ?? '')==2)?'selected':''}}>2</option>
        <option {{ (old('ad_weight', $element->ad_weight ?? '')==4)?'selected':''}}>4</option>
    </select>
</div>
