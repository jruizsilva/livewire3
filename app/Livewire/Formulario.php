<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use function PHPUnit\Framework\isEmpty;

// #[Lazy()]
class Formulario extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $categories;
    #[Url(as: 's')]
    public $search = '';

    public $tags;

    // #[Rule('required|min:3', as: "nombre")]
    // public $title;
    // #[Rule('required|min:3')]
    // public $content;
    // #[Rule('required|exists:categories,id')]
    // public $category_id = '';
    // #[Rule('required|array')]
    // public $selectedTags = [];

    // #[Rule([
    //     'postCreate.title' => 'required|min:3',
    //     'postCreate.content' => 'required|min:3',
    //     'postCreate.category_id' => 'required|exists:categories,id',
    //     'postCreate.tags' => 'required|array'
    // ], [], [
    //     'postCreate.title' => 'nombre',
    //     'postCreate.content' => 'contenido',
    //     'postCreate.category_id' => 'categoría',
    //     'postCreate.tags' => 'etiquetas'
    // ])]
    public PostCreateForm $postCreate;

    public PostEditForm $postEdit;

    // public function rules()
    // {
    //     return [
    //         'postCreate.title' => 'required|min:3',
    //         'postCreate.content' => 'required|min:3',
    //         'postCreate.category_id' => 'required|exists:categories, id',
    //         'postCreate.tags' => 'required|array'
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'postCreate.title.required' => 'El :attribute es obligatorio',
    //         'postCreate.title.min' => 'El :attribute debe tener al menos 3 caracteres',
    //         'postCreate.content.required' => 'El :attribute es obligatorio',
    //         'postCreate.content.min' => 'El :attribute debe tener al menos 3 caracteres',
    //         'postCreate.category_id.required' => 'El :attribute es obligatorio',
    //         'postCreate.category_id.exists' => 'La :attribute no existe',
    //         'postCreate.tags.required' => 'El :attribute es obligatorio',
    //         'postCreate.tags.array' => 'El :attribute debe ser un array'
    //     ];
    // }

    // public function validationAttributes()
    // {
    //     return [
    //         'postCreate.title' => 'nombre',
    //         'postCreate.content' => 'contenido',
    //         'postCreate.category_id' => 'categoría',
    //         'postCreate.tags' => 'etiquetas'
    //     ];
    // }


    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function updating($property, $value)
    {
        if ($property == 'postCreate.category_id') {
            if ($value > 3) {
                throw new \Exception('No se puede seleccionar esta categoría');
            }
        }
    }

    public function updated($property, $value)
    {
        if ($property == 'postCreate.category_id') {
            // throw new \Exception('Cambio');
        }
    }

    public function hydrate()
    {
    }
    public function dehydrate()
    {
    }

    // public function placeholder()
    // {
    //     return view('livewire.placeholders.skeleton');
    // }

    public function render()
    {
        $posts = Post::orderBy('id', 'desc')
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->paginate(3, pageName: 'page_posts');
        $data = [
            'posts' => $posts,
        ];
        return view('livewire.formulario', $data);
    }

    public function save()
    {
        sleep(2);
        $this->postCreate->save();
        $this->resetPage(pageName: 'page_posts');

        $this->dispatch('post-created', 'Post creado');
    }

    public function edit($postId)
    {
        $this->postEdit->edit($postId);
    }

    public function update()
    {
        $this->postEdit->update();

        $this->dispatch('post-created', 'Post actualizado');
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        $this->dispatch('post-created', 'Post eliminado');
    }

    // public function paginationView()
    // {
    //     return 'vendor.livewire.simple-tailwind';
    // }
}
