<div class="form-group ">
    <label for="{{ $name }}"
           class="col-form-label text-md-right">{{ $caption }}</label>

    <input id="{{ $name }}" type="file"
           class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
           name="{{ $name }}">
    @if($description != "") <small>{{ $description }}</small>  @endif
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>