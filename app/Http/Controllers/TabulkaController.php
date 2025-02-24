<?php

namespace App\Http\Controllers;

use App\Models\Tabulka;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TabulkaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tabulkas = Tabulka::get()->map(function ($tabulka) {
            $wrappedName = wordwrap($tabulka->name, 15, "\n", true);
            $wrappedDescription = wordwrap($tabulka->description, 39, "\n", true);
            $nameLines = substr_count($wrappedName, "\n") + 1;
            $descriptionLines = explode("\n", $wrappedDescription);

            if (count($descriptionLines) > $nameLines) {
                $limitedDescription = array_slice($descriptionLines, 0, $nameLines);
                $lastLineIndex = count($limitedDescription) - 1;
                $limitedDescription[$lastLineIndex] .= '...';
                $tabulka->description = implode("\n", $limitedDescription);
                
            } else {
                $tabulka->description = $wrappedDescription;
            }

            $tabulka->name = nl2br($wrappedName);
            $tabulka->description = nl2br($tabulka->description);
    
            return $tabulka;
        });

        return view("tabulka.index", [
            'tabulkas' => $tabulkas
        ]);
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

        return redirect("/tabulka")->with("status","Úloha bola úspešne vytvorená");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tabulka $tabulka)
    {
        return view("tabulka.show", compact('tabulka'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabulka $tabulka)
    {
        return view("tabulka.edit", compact('tabulka'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tabulka $tabulka)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
            "status" => "nullable",
        ]);

        $tabulka->update([
            "name" => $request->name,
            "description" => $request->description,
            "status" => $request->status == true ? 1:0,
        ]);

        return redirect("/tabulka")->with("status","Úloha bola úspešne pozmenená");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tabulka $tabulka)
    {
        $tabulka->delete();
        return redirect("/tabulka")->with("status","Úloha bola úspešne odstránená");
    }
}
