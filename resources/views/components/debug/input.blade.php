<label for="{{ $name }}">{{ $name }}</label>
<input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
    @if ($value ?? false) value="{{ $value }}" @endif
    @if ($placeholder ?? false) placeholder="{{ $placeholder }}" @endif
    @if ($required ?? false) required @endif>
<input type="hidden" name="debug_nonce_{{ $name }}" value="{{ $nonce }}">
