<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    /**
     * List all posts
     *
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::orderByDesc('created_at')->get();
        return view('post.list', ['posts' => $posts]);
    }

    /**
     * Show form to create new post
     *
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('post.create');
    }

    /**
     * Store new post
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        // remove tinymce dots from image path
        $validated['body'] = str_replace('../storage/uploads', '/storage/uploads', $validated['body']);
        // assign post to current user
        $validated['user_id'] = Auth::id();

        $post = Post::create($validated);

        $this->updateTagsAttachments($request->tags, $post);

        // check if body contains any images
        preg_match_all('/src="([^"]*)"/', $request->body, $result);
        // if body contains images, assign one to the post to show in preview
        if (!empty($result[0])) {
            $imagePath = count($result[0]) > 1 ? $result[0][1] : $result[1][0];
            $image = File::firstWhere('path', substr($imagePath, 2));
            if ($image) {
                $image->post_id = $post->id;
                $image->save();
            }
        }

        return to_route('dashboard');
    }

    /**
     * Show post content
     *
     * @param string $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->posts = Post::orderByDesc('created_at')->get();
        $post = Post::findOrFail($id);

        $tagIds = $post->tags->pluck('id')->toArray();
        $similarPosts = [];

        $similarPostIds = DB::table('posts')
            ->join('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->join('tags', 'tags.id', '=', 'post_tag.tag_id')
            ->select('posts.id')
            ->whereIn('tags.id', $tagIds)
            ->where('posts.id', '!=', $post->id)
            ->where('posts.deleted_at',  null)
            ->where('posts.user_id', '!=', Auth::id())
            ->take(5)
            ->distinct()
            ->get()->pluck('id')->toArray();

        if (!empty($similarPostIds)) {
            $similarPosts = Post::whereIn('id', $similarPostIds)
                ->get();
        }

        return view('post.show', ['post' => $post, 'similarPosts' => $similarPosts]);
    }

    /**
     * Show form to edit post
     *
     * @param string $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $post = Post::findOrFail($id);

        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update post
     *
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $post = Post::find($id);
        $post->update($request->all());

        $this->updateTagsAttachments($request->tags, $post);

        return to_route('post.show', ['post' => $post]);
    }

    /**
     * Create tags and update their connections to the post
     *
     * @param $tags
     * @param $post
     * @return void
     */
    private function updateTagsAttachments($tags, $post): void
    {
        if (!empty($tags)) {
            $insertTags = [];

            foreach ($tags as $tag) {
                $insertTags[] = ['name' => $tag];
            }

            // create tags if they don't exist yet
            DB::table('tags')->insertOrIgnore($insertTags);
            $attachTags = Tag::whereIn('name', $tags)->get();

            // sync new tags with post
            $post->tags()->sync($attachTags);
        }
    }

}
