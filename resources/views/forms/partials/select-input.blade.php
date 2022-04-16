@props(['disabled' => false, 'title' => ''])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
    @if (!empty($title))
        <option value="">-- select a {{ $title }} --</option>
    @endif

    {{ $slot }}
</select>
