<div>
    {{-- @livewire('hijo') --}}
    {{-- <x-button wire:click="$set('count', 0)">Resetear</x-button> --}}
    <x-button class="mb-4" wire:click="$toggle('open')">Mostrar / Ocultar</x-button>
    @if ($open)
        <form class="mb-4" wire:submit="save">
            <x-input placeholder="Ingrese un pais" wire:model="pais" wire:keydown.space="increment" />
            <x-button type="submit">Agregar</x-button>
        </form>
        <ul class="list-disc list-inside space-y-2">
            @foreach ($paises as $index => $pais)
                <li wire:key="pais-{{ $index }}">
                    ({{ $index }})
                    <span wire:mouseenter="changeActive('{{ $pais }}')">{{ $pais }}</span>
                    <x-danger-button wire:click="delete('{{ $index }}')">X</x-danger-button>
                </li>
            @endforeach
        </ul>

        <h2>Active: {{ $active }}</h2>
        <h2>Contador: {{ $count }}</h2>
    @endif
</div>
