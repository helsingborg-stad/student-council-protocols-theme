{{-- Radio field --}}
<div class="mod-form-field">
    <p><b><label for="{{ $module_id }}-{{ $field['name'] }}">
        {{ $field['label'] }}{!! $field['required'] ? '<span class="text-danger">*</span>' : '' !!}
    </label></b></p>
</div>
<ul style="list-style-type:none">
    <input type="hidden" name="mod-form[{{ $field['name'] }}][]">
    @foreach ($field['values'] as $value)
        <li>
            <label class="checkbox-container">
                <input class="checkbox" type="checkbox" name="mod-form[{{ $field['name'] }}][]" {{ $field['required'] ? 'required' : '' }} value="{{ $value['value'] }}" {{ is_array($field['value']) && in_array($value['value'], $field['value']) ? 'checked' : '' }}>
                <span class="checkmark"></span>
                <span class="checkbox-title">{{ $value['value'] }}</span>
            </label>
        </li>
    @endforeach
</ul>
