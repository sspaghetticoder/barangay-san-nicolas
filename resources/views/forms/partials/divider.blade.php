<div class="py-6 mb-4 border-b border-gray-200">
    @if (isset($title))
        <label for="" class="font-bold text-xl">{{ $title }}</label>
    @endif

    <p>
        @if (isset($description))
            {{ $description }}
        @else
            This information must be kept private be careful what you share. Note: (<span class="text-red-500">*</span>) is required.
        @endif
    </p>
</div>
