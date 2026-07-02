<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <div class="input-group input-password__container">
        <input type="{{ $type }}" class="form-control input-password" name="{{ $name }}" id="{{ $name }}"
            placeholder="{{ $placeholder }}" required>
        <button class="btn btn-outline-secondary input-password__toggle-btn" type="button">
            <i class="fas fa-eye fa-fw"></i>
        </button>
    </div>
    <span class="invalid-feedback"></span>
</div>
