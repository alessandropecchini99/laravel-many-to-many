<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.create',  compact('types', 'technologies'));
    }


    public function store(Request $request)
    {
        // validazione
        $request->validate(
            [
                'title'         => 'required|string|min:5|max:100',
                'type_id'       => 'required|integer|exists:types,id',
                'url_image'     => 'nullable|url|max:200',
                'upImage'       => 'nullable|image|max:1024',
                'content'       => 'required|string',
            ],
            // custom error message 
            // [
            //     'title.required'    => 'Title required!',
            //     'title.min'         => 'Title needs minimum 5 letter!',
            // ]
        );

        // prendo i dati dalla create page
        $data = $request->all();

        // salvare l'upImage nella cartella degli uploads
        // prendere il percorso dell'immagine appena salvata
        $imagePath = Storage::put('uploads', $data['upImage']);

        // salvare i dati in db se validi insieme al percorso delle immagini
        $newPost = new Post();
        $newPost->title         = $data['title'];
        $newPost->slug          = Post::slugger($data['title']);
        $newPost->type_id       = $data['type_id'];
        $newPost->content       = $data['content'];
        $newPost->url_image     = $data['url_image'];
        $newPost->upImage       = $imagePath;
        $newPost->save();

        // associare le technologies
        $newPost->technologies()->sync($data['technologies'] ?? []);

        // returnare in una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $newPost]);
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('admin.posts.show', compact('post'));
    }


    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.edit', compact('post', 'types', 'technologies'));
    }


    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // validare i dati del form
        $request->validate(
            [
                'title'             => 'required|string|min:5|max:100',
                'type_id'           => 'required|integer|exists:types,id',
                'content'           => 'required|string',
                'url_image'         => 'nullable|url|max:200',
                'upImage'           => 'nullable|image|max:1024',
                'technologies'      => 'nullable|array',
                'technologies.*'    => 'integer|exists:technologies,id',
            ]
        );

        $data = $request->all();

        if ($data['upImage']) {
            // salvare l'eventuale nuova upImage
            $imagePath = Storage::put('uploads', $data['upImage']);

            // in caso di nuova upImage, eliminare l'upImage precedente
            if ($post->upImage) {
                Storage::delete($post->upImage);
            }

            // in caso di nuova upImage, aggiorno il valore in colonna
            $post->upImage = $imagePath;
        }

        // aggiornare i dati nel db se validi
        $post->title        = $data['title'];
        $post->type_id      = $data['type_id'];
        $post->url_image    = $data['url_image'];
        $post->content      = $data['content'];
        $post->update();

        // associare i tag
        $post->technologies()->sync($data['technologies'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $post]);
    }


    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $post->delete(); // se settiamo in model e in migrate il softdelete, cambia in automatico

        return to_route('admin.posts.index')->with('softdelete_success', $post);
    }

    public function restore($id)
    {
        Post::withTrashed()
            ->where('id', $id)
            ->restore();

        $post = Post::find($id);

        return to_route('admin.posts.index')->with('restore_success', $post);
    }

    public function trashed()
    {
        $trashedPosts = Post::onlyTrashed()->paginate(5); // SELECT * FROM 'posts'

        return view('admin.posts.trashed', compact('trashedPosts'));
        // OR
        // return view('posts.trashed', [
        //     'posts' => $trashedPosts,
        // ]);
    }

    public function harddelete($slug)
    {
        $post = Post::withTrashed()->where('slug', $slug)->firstOrFail();

        if ($post->upImage) {
            Storage::delete($post->upImage);
        }

        //dissociare tutti i tag dal post
        $post->technologies()->detach();
        // OR
        // $post->technologies()->sync([]);

        $post->forceDelete();

        return to_route('admin.posts.index')->with('harddelete_success', $post);
    }
}
