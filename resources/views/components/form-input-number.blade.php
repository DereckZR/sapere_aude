<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="text" class="form-control input-number" name="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $placeholder }}" data-is-decimal="{{ $isDecimal ? '1' : '0' }}" required>
    <span class="invalid-feedback"></span>
</div>
