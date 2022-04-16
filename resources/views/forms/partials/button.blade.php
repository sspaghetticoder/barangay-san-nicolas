@props(['link' => '', 'type' => 'primary', 'title' => '', 'class' => 'ml-1 px-4 py-2 rounded-md'])

@php
    $theme = '';

    switch ($type) {
        case 'info':
            $theme = 'bg-blue-500 hover:bg-blue-700 text-white';
            break;
        case 'success':
            $theme = 'bg-green-500 hover:bg-green-700 text-white';
            break;
        case 'danger':
            $theme = 'bg-red-500 hover:bg-red-700';
            break;
        case 'secondary':
            $theme = 'bg-white hover:bg-gray-100 border border-gray-400';
            break;
        case 'warning':
            $theme = 'bg-orange-500 hover:bg-orange-700';
            break;
        default:
            $theme = 'bg-indigo-500 hover:bg-indigo-700 text-white';
            break;
    }

    $class = $theme . ' ' . $class;
@endphp

<div>
    @if (empty($link))
        <button {!! $attributes->merge(['class' => $class, 'type' => 'submit']) !!}>
            {{ $title }}
        </button>
    @else
        <a href="{{ $link }}">
            <button {!! $attributes->merge(['class' => $class, 'type' => 'button']) !!}>
                {{ $title }}
            </button>
        </a>
    @endif
</div>
