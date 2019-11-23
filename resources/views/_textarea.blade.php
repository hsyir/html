<div class="form-group ">
    <label for="{{ $name }}"
           class=" col-form-label text-md-right">{{ $label ?? "" }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}"
              placeholder="{{ $placeholder ?? "" }}"
              class="form-control textarea {{ $errors->has($name) ? ' is-invalid' : '' }}">{{ $value ?? "" }}</textarea>
    @if($description != "") <small>{{ $description }}</small>  @endif
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
             <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
