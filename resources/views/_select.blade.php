<div class="form-group ">
    <label for="{{ $name }}"
           class="col-form-label text-md-right">{{ $caption }}</label>

    <select id="{{ $name }}"
            {{ $disabled ? 'disabled' : "" }}
            name="{{ $name }}"
            class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}">
        @foreach($select_options as $key=>$option)
            <option value="{{ $key }}" {{( $key != "" and $key==$value) ? "selected" : "" }}>{{  $option }}</option>
        @endforeach
    </select>
    @if($description != "") <small>{{ $description }}</small>  @endif
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($name) }}</strong>
                                    </span>
    @endif
</div>