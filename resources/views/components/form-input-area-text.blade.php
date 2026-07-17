<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea class="form-control" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
        rows="{{ $rows }}" {{ $required ? 'required' : '' }}></textarea>
    <span class="invalid-feedback"></span>
</div>
