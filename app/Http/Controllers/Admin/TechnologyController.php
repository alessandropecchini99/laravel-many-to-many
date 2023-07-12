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
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }


    public function edit(Technology $technology)
    {
        //
    }


    public function update(Request $request, Technology $technology)
    {
        //
    }


    public function destroy(Technology $technology)
    {
        //dissociare tutti i tag dal technology
        $technology->posts()->detach();

        //elimino
        $technology->delete();

        return to_route('admin.technologies.index')->with('delete_success', $technology);
    }
}
