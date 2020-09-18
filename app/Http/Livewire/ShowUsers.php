<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $posts = false;
    public $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
        'posts' => ['except' => false],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->fill(request()->only('search', 'posts', 'page'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query()
            ->select(['id', 'name', 'email'])
            ->usingSearchString( $this->search );

        if ($this->posts) {
            $query->with('posts:id,user_id,title');
        }

        $results = $query->paginate(10);

        return view('livewire.show-users', [
            'results' => $results,
        ]);
    }
}
