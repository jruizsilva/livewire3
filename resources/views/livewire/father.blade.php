<div>
    @persist('player')
        <audio src="{{ asset('audios/1.mp3') }}" controls></audio>
    @endpersist
    <x-button wire:click="redirectTo('prueba')">Ir a prueba</x-button>

    <h1 class="text-2xl font-semibold">
        Componente Padre
    </h1>
    <x-input wire:model.live="name"></x-input>

    <hr class="my-6">
    <div>
        {{-- @livewire('children', [
            'name' => $name,
        ]) --}}
        {{-- <livewire:children wire:model="name" /> --}}
        @livewire('contador', [], key('contador-1'))
        @livewire('contador', [], key('contador-2'))
        @livewire('contador', [], key('contador-3'))

        <livewire:contador key="contador-4" />
    </div>

    {{-- <script data-navigate-once>
        // const a = 'a';
        // console.log(a);

        document.addEventListener('livewire:navigated', function() {
            console.log('hola desde father');
        })
    </script> --}}
    @push('js')
        <script>
            console.log("hola desde father");
        </script>
    @endpush
</div>
