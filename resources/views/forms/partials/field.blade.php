@props(['required' => false])

<div {!! $attributes->merge(['class' => 'grid grid-cols-12 py-6 mb-4 border-b border-gray-200']) !!}>
    <div class="col-span-4 pt-2">
        @if (isset($title))
            <label for="" class="font-bold text-sm">{{ $title }} @if ($required) <span class="text-red-500">*</span> @endif</label>
        @endif
    </div>
    <div class="col-span-8">
        {{ $slot }}
    </div>
</div>
