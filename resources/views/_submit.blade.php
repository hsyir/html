<div class="">
    <button class="btn btn-success {{ $class ?? "" }}"
            @includeWhen(isset($attributes),"html::__attributes") type="submit"> {{ $label }}</button>
</div>