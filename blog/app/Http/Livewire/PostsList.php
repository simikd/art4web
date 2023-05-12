<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostsList extends Component
{

    public function render()
    {
        $this->posts = Post::orderByDesc('created_at')->get();
        return view('livewire.posts-list');
    }

    public function getTags()
    {
        $this->tags = ['nieco', 'nieco ine', 'uplne odveci'];
    }


    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
