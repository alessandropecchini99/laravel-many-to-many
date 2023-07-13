<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{

    public function index()
    {
        $technologies = Technology::paginate(5);
        return view('admin.technologies.index', compact('technologies'));
    }


    public function create()
    {
        return view('admin.technologies.create');
    }


    public function store(Request $request)
    {
        // validazione
        $request->validate(
            [
                'name'          => 'required|string|max:20',
            ]
        );

        // prendo i dati dalla create page
        $data = $request->all();

        // salvare i dati in db se validi
        $newTechnology            = new Technology();
        $newTechnology->name      = $data['name'];
        $newTechnology->save();

        // returnare in una rotta di tipo get
        return to_route('admin.technologies.show', ['technology' => $newTechnology]);
    }


    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }


    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }


    public function update(Request $request, Technology $technology)
    {
        // validazione
        $request->validate(
            [
                'name'          => 'required|string|max:20',
            ]
        );

        $data = $request->all();

        // aggiornare i dati nel db se validi
        $technology->name         = $data['name'];
        $technology->update();

        // ridirezionare su una rotta di tipo get
        return to_route('admin.technologies.show', ['technology' => $technology]);
    }


    public function destroy(Technology $technology)
    {
        $technology->delete(); // se settiamo in model e in migrate il softdelete, cambia in automatico

        return to_route('admin.technologies.index')->with('softdelete_success', $technology);
    }

    public function restore($id)
    {
        Technology::withTrashed()
            ->where('id', $id)
            ->restore();

        $technology = Technology::find($id);

        return to_route('admin.technologies.index')->with('restore_success', $technology);
    }

    public function trashed()
    {
        $trashedTechnologies = Technology::onlyTrashed()->paginate(5); // SELECT * FROM 'posts'

        return view('admin.technologies.trashed', compact('trashedTechnologies'));
    }

    public function harddelete($id)
    {
        // trovo la technology da eliminare
        $technology = Technology::withTrashed()->find($id);

        // technology_id in cui mandare i post
        $defaultTech = Technology::find(1);

        // seleziono i post da spostare nel nuovo technology_id
        $postsId = $technology->posts->pluck('id')->all();

        //dissociare tutti i tag dal technology
        $technology->posts()->detach();

        // associo i post al nuovo technology_id
        foreach ($postsId as $post) {
            $defaultTech->posts()->attach($post);
        }

        // ALTERNATIVA: eliminare direttamente la technology
        // $technology->posts()->detach();

        // ora che la technology non è collegata a dei post, posso eliminarla
        $technology->forceDelete();

        return to_route('admin.technologies.index')->with('harddelete_success', $technology);
    }
}
