<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Post;

class PostsList extends Component
{

    // tag filter
    public $tag;

    /**
     * render all posts
     *
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::orderByDesc('created_at')->get();

        return view('livewire.posts-list', [
            'tagFilter' => $this->tag,
            'posts' => $posts
            ->when($this->tag, function ($posts, $tag) { // when tag is specified, use it to filter post records
                return $posts->filter(function ($post) use ($tag) {
                    return $post->tags
                        ->pluck('name')
                        ->containsStrict($tag);
                });
            })
        ]);
    }

    /**
     * Specify a tag for posts filtering
     *
     * @param string $tag
     */
    public function filterByTag(string $tag): void
    {
        $this->tag = $tag;
    }


    /**
     * Delete post record
     *
     * @param $id
     * @return void
     */
    public function delete($id): void
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
