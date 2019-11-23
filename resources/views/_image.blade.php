<div class="form-group border p-2">
    <label for="{{ $name }}"
           class="col-form-label text-md-right">{{ $label }}</label>

    <div class="custom-file">
        <input type="file" class="hasImageViewer custom-file-input {{ $errors->has($name) ? ' is-invalid' : '' }}"
               name="{{ $name }}"
               data-image="{{ $name }}"
               id="file_{{ $name }}">
        <label class="custom-file-label" for="customFile">انتخاب فایل</label>

        @if ($errors->has($name))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($name) }}</strong>
                                    </span>
        @endif
    </div>
    <small>{{ $description??"" }}</small>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <img id="{{ $name }}" @includeWhen(isset($attributes),"html::__attributes")  class="w-100 "/>
        </div>
    </div>
</div>