<div class="form-group ">
    <label for="{{ $name }}" class="col-form-label text-md-right">{{ $label ?? "" }}</label>
    <input id="{{ $name }}" @includeWhen(isset($attributes),"html::__attributes" ) value="{{ $value }}"
    type="text" name="{{ $name }}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $class ?? "" }}">
    <small>{{ $description ?? "" }}</small>
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first($name) }}</strong></span>
    @endif
</div>
