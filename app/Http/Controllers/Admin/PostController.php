<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //convalida dati
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image'
        ]);

        $form_data = $request->all();

        //verifico se l'immagine è stata caricata
        if(array_key_exists('image', $form_data)) {
            //salviamo l'immagine e recuperiamo il path
            $cover_path = Storage::put('post_covers', $form_data['image']);
            //aggiungiamo all'array della funzione fill la chiave cover
            //che contiene il percorse relativo dell'immagine a partire da public/storage
            $form_data['cover'] = $cover_path;
        }

        $new_post = new Post();
        $new_post->fill($form_data);

        $slug = Str::slug($new_post->title, '-');
        $slug_presente = Post::where('slug', $slug)->first();
        $cont = 1;
        while($slug_presente) {
            $slug = $slug . '-' . $cont;
            $slug_presente = Post::where('slug', $slug)->first();
            $cont++;
        }
        $new_post->slug = $slug;
        $new_post->save();
        $new_post->tags()->attach($form_data['tags']);
        return redirect()->route('admin.posts.index')->with('inserted', 'Il post è stato correttamente salvato');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //select * from posts where slug = $slug
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if(!$post) {
            abort(404);
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //convalida dati
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image'
        ]);
        
        $data = $request->all();
        //verifico se il titolo ricevuto dal form è diverso dal vecchio titolo
        if ($data['title'] != $post->title){
            //è stato modificato il titolo quindi modifico anche lo slug
            $slug = Str::slug($data['title'], '-');
            $slug_presente = Post::where('slug', $slug)->first();
            $cont = 1;
            while($slug_presente) {
                $slug = $slug . '-' . $cont;
                $slug_presente = Post::where('slug', $slug)->first();
                $cont++;
            }
            $data['slug'] = $slug;
        }
        //verifico se è stata un'immagine
        if (array_key_exists('image', $data)) {
            //elimino vecchia immagine e salvo l'immagine e recupero il path
            Storage::delete($post->cover);
            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path;
        }

        $post->update($data);
        //if($data->tags) ----> equivalente
        if (array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }
        return redirect()->route('admin.posts.index')->with('updated', 'Il post è stato correttamente aggiornato');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        //il rigo sotto è superfluo perchè nella migration della tabella ponte abbiamo inserito onDelete('cascade');
        // $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Il post è stato correttamente eliminato');
    }

    public function deleteImage($cover_path) {
        $cover_path = 'post_covers/' . $cover_path;
        Storage::delete($cover_path);
        return redirect()->route('admin.posts.index');
    }
}