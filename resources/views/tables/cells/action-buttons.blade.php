<div x-data="{ buttonDisabled: false }" class="flex">
    @if (isset($viewLink))
        <x-form::button x-on:click="buttonDisabled = true" x-bind:disabled="buttonDisabled" title="View" type="primary" :link="$viewLink"
            class="text-white font-bold py-1 px-2 rounded-sm" />
    @endif

    @if (isset($editLink))
        <x-form::button x-on:click="buttonDisabled = true" x-bind:disabled="buttonDisabled" title="Edit" type="info" :link="$editLink"
            class="ml-1 text-white font-bold py-1 px-2 rounded-sm" />
    @endif

    @if (isset($deleteLink))
        <form action="{{ $deleteLink }}" method="POST">
            @csrf
            @method('DELETE')
            <x-form::button onClick="this.form.submit(); this.disabled=true;" title="Delete" type="danger" class="ml-1 text-white font-bold py-1 px-2 rounded-sm" />
        </form>
    @endif

    @if (isset($undoLink))
        <form action="{{ $undoLink }}" method="POST">
            @csrf
            @method('PUT')
            <x-form::button onClick="this.form.submit(); this.disabled=true;" title="Undo" type="secondary" class="font-bold py-1 px-2 rounded-sm" />
        </form>
    @endif
</div>
