<div>
    <h1>Hola desde el componente</h1>
    <h2>{{ $title }}</h2>
    <h2>Nombre: {{ $name }}</h2>
    <h2>Email: {{ $email }}</h2>

    <div>
        <x-input type="text" wire:model.live="name" />

        <x-button wire:click="save">Save</x-button>
    </div>

    {{ $name }}
</div>
