<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $name }}"
        value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" {{ $required ? 'required' : '' }}>
    <span class="invalid-feedback"></span>
</div>
