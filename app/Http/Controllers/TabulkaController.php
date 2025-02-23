<?php

namespace App\Http\Controllers;

use App\Models\Tabulka;
use Illuminate\Http\Request;

class TabulkaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("tabulka.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tabulka.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
            "status" => "nullable",
        ]);

        Tabulka::create([
            "name" => $request->name,
            "description" => $request->description,
            "status" => $request->status == true ? 1:0,
        ]);

        return redirect("/tabulka")->with("status","Category Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tabulka $tabulka)
    {
        return view("tabulka.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabulka $tabulka)
    {
        return view("tabulka.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tabulka $tabulka)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tabulka $tabulka)
    {
        //
    }
}
