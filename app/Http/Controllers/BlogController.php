<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Administrativo;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::with(['autor', 'tratamiento'])->get();
        return view('blog.index', compact('posts'));
    }

    public function create()
    {
        return view('blog.create', [
            'admins' => Administrativo::all(),
            'tratamientos' => Tratamiento::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'autor_id' => 'nullable|exists:administrativo,id_admin',
            'id_tratamiento' => 'nullable|exists:tratamiento,id_tratamiento',
            'enlace_cita' => 'required|boolean'
        ]);

        Blog::create($request->all());

        return redirect()->route('blog.index')->with('success', 'Post creado correctamente');
    }

    public function show($id)
    {
        $post = Blog::with(['autor', 'tratamiento'])->findOrFail($id);
        return view('blog.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Blog::findOrFail($id);

        return view('blog.edit', [
            'post' => $post,
            'admins' => Administrativo::all(),
            'tratamientos' => Tratamiento::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);

        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'autor_id' => 'nullable|exists:administrativo,id_admin',
            'id_tratamiento' => 'nullable|exists:tratamiento,id_tratamiento',
            'enlace_cita' => 'required|boolean'
        ]);

        $post->update($request->all());

        return redirect()->route('blog.index')->with('success', 'Post actualizado correctamente');
    }

    public function destroy($id)
    {
        Blog::destroy($id);
        return redirect()->route('blog.index')->with('success', 'Post eliminado');
    }
}
