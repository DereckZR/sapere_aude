<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control" name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }}>
    </select>
    <span class="invalid-feedback"></span>
</div>
