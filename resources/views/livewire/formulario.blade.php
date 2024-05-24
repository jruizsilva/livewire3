<div>
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        @if ($postCreate->image)
            <img src="{{ $postCreate->image->temporaryUrl() }}">
        @endif
        <form wire:submit="save">
            <div class="mb-4">
                <x-label>Nombre</x-label>
                <x-input class="w-full" wire:model.live="postCreate.title" />
                <x-input-error for="postCreate.title" />
            </div>
            <div class="mb-4">
                <x-label>Contenido</x-label>
                <x-textarea class="w-full min-h-20" wire:model="postCreate.content"></x-textarea>
                <x-input-error for="postCreate.content" />
            </div>
            <div class="mb-4">
                <x-label>Categoria</x-label>
                <x-select wire:model.live="postCreate.category_id" class="w-full">
                    <option value="" disabled>Seleccione una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="postCreate.category_id" />
            </div>
            <div class="mb-4" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <x-label>Imagen</x-label>
                <x-input type="file" wire:model="postCreate.image" />
                <!-- Progress Bar -->
                <div x-show="uploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
            <div class="mb-4">
                <x-label>Etiquetas</x-label>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label>
                                <x-checkbox wire:model="postCreate.tags" value="{{ $tag->id }}" />
                                {{ $tag->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
                <x-input-error for="postCreate.tags" />
            </div>
            <div class="flex justify-end">
                <x-button type="submit" class="disabled:opacity-25" wire:loading.attr="disabled"
                    wire:target="save">Crear</x-button>
            </div>
        </form>

        <div wire:loading.delay wire:target="save" class="w-full">
            <div class="flex justify-between">
                <div>Loading...</div>
                <div>Loading...</div>
            </div>
        </div>

        {{-- <div class="flex justify-between" wire:loading.flex wire:target="save">
            <div>hola</div>
            <div>mundo</div>
        </div>

        <div wire:loading.delay wire:target="save">
            Procesando...
        </div> --}}
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-4">
            <x-input class="w-full" placeholder="Buscar..." wire:model.live="search"></x-input>
        </div>
        <ul class="list-disc list-inside space-y-2">
            @foreach ($posts as $post)
                <li wire:key="post-{{ $post['id'] }}" class="flex justify-between">
                    {{ $post['title'] }}
                    <div>
                        <x-button wire:click="edit({{ $post['id'] }})">Editar</x-button>
                        <x-danger-button wire:click="destroy({{ $post['id'] }})">Eliminar</x-danger-button>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{ $posts->links(data: ['scrollTo' => false]) }}
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>

    {{-- Formulario de edición --}}
    {{-- @if ($postEdit . open)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="py-12">
                <div class="max-w-md mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow rounded-lg p-6 mb-8">
                        <form wire:submit="update">
                            <div class="mb-4">
                                <x-label>Nombre</x-label>
                                <x-input class="w-full" wire:model="postEdit.title" required />
                            </div>
                            <div class="mb-4">
                                <x-label>Contenido</x-label>
                                <x-textarea class="w-full min-h-20" wire:model="postEdit.content" required></x-textarea>
                            </div>
                            <div class="mb-4">
                                <x-label>Categoria</x-label>
                                <x-select wire:model="postEdit.category_id" class="w-full" required>
                                    <option value="" disabled>Seleccione una categoria</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="mb-4">
                                <x-label>Etiquetas</x-label>
                                <ul>
                                    @foreach ($tags as $tag)
                                        <li>
                                            <label>
                                                <x-checkbox wire:model="postEdit.tags" value="{{ $tag->id }}" />
                                                {{ $tag->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="flex justify-end">
                                <x-danger-button wire:click="$set('postEdit.open', false)"
                                    class="mr-2">Cancelar</x-danger-button>
                                <x-button type="submit">Actualizar</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}

    <form wire:submit="update">
        <x-dialog-modal wire:model="postEdit.open">
            <x-slot name="title">
                Actualizar post
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" wire:model="postEdit.title" />
                    <x-input-error for="postEdit.title" />
                </div>
                <div class="mb-4">
                    <x-label>Contenido</x-label>
                    <x-textarea class="w-full min-h-20" wire:model="postEdit.content"></x-textarea>
                    <x-input-error for="postEdit.content" />
                </div>
                <div class="mb-4">
                    <x-label>Categoria</x-label>
                    <x-select wire:model="postEdit.category_id" class="w-full">
                        <option value="" disabled>Seleccione una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="postEdit.category_id" />
                </div>
                <div class="mb-4">
                    <x-label>Etiquetas</x-label>
                    <ul>
                        @foreach ($tags as $tag)
                            <li>
                                <label>
                                    <x-checkbox wire:model="postEdit.tags" value="{{ $tag->id }}" />
                                    {{ $tag->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="postEdit.tags" />
                </div>

            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button wire:click="$set('postEdit.open', false)" class="mr-1">Cancelar</x-danger-button>
                    <x-button type="submit">Actualizar</x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>

    @push('js')
        <script>
            Livewire.on('post-created', function(comment) {
                console.log(comment);
            })
        </script>
    @endpush

    {{-- <script>
        document.addEventListener('livewire:initialized', function() {
            Livewire.on('post-created', function(comment) {
                console.log(comment);
            })
        })
    </script> --}}

</div>
