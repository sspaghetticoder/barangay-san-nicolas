@props(['method' => 'POST', 'action' => '#'])

<form method="{{ $method }}" action="{{ $action }}">
    @csrf
    @if (isset($subMethod))
        {{ $subMethod }}        
    @endif

    @if (isset($content))
        <div class="px-10 py-8 rounded-sm border border-gray-200 shadow-sm bg-white">
            {{ $content }}
        </div>
    @else   
        {{ $slot }}
    @endif
</form>
