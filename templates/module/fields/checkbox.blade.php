<div class="grid mod-form-field" {!! $field['conditional_hidden'] !!}>
    <div class="grid-md-12">
        <div class="form-group checkbox-group">
            <label for="{{ $module_id }}-{{ sanitize_title($field['label']) }}">{{ $field['label'] }}{!!  $field['required'] ? '<span class="text-danger">*</span>' : '' !!}</label>
            {!! !empty($field['description']) ? '<div class="text-sm text-dark-gray">' . ModularityFormBuilder\Helper\SanitizeData::convertLinks($field['description']) . '</div>' : '' !!}
            @foreach ($field['values'] as $value)
                <label class="checkbox checkbox-container">
                    <input class="input-checkbox {{ $field['required'] ? 'required' : '' }}" type="checkbox" name="{{ sanitize_title($field['label']) }}[]" value="{{ $value['value'] }}">
                    <span class="checkmark"></span>
                    <span class="checkbox-title">{{ $value['value'] }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>