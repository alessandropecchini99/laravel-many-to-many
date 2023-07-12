<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::paginate(5);
        return view('admin.types.index', compact('types'));
    }


    public function create()
    {
        return view('admin.types.create');
    }


    public function store(Request $request)
    {
        // validazione
        $request->validate(
            [
                'name'          => 'required|string|max:20',
                'description'   => 'required|string',
            ]
        );

        // prendo i dati dalla create page
        $data = $request->all();

        // salvare i dati in db se validi
        $newType = new Type();
        $newType->name          = $data['name'];
        $newType->description   = $data['description'];
        $newType->save();

        // returnare in una rotta di tipo get
        return to_route('admin.types.show', ['type' => $newType]);
    }


    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }


    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }


    public function update(Request $request, Type $type)
    {
        // validazione
        $request->validate(
            [
                'name'          => 'required|string|max:20',
                'description'   => 'required|string',
            ]
        );

        $data = $request->all();

        // aggiornare i dati nel db se validi
        $type->name         = $data['name'];
        $type->description  = $data['description'];
        $type->update();

        // ridirezionare su una rotta di tipo get
        return to_route('admin.types.show', ['type' => $type]);
    }


    public function destroy(Type $type)
    {
        //dissociare tutti i tag dal post
        foreach ($type->posts as $post) {
            $post->type_id = 1;
            $post->update();
        }

        //elimino
        $type->delete();

        return to_route('admin.types.index')->with('delete_success', $type);
    }
}
