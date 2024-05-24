<div>
    Contador: {{ $count }}
    <br>
    <x-button wire:click="increment(2)">+</x-button>
    <x-button wire:click="decrement">-</x-button>
    <x-button wire:click="resetCount">Reset</x-button>
</div>
