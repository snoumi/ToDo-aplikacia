<?php

namespace App\Http\Controllers;

use App\Models\Tabulka;
use Illuminate\Http\Request;

class TabulkaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tabulka::query();

        $search = $request->session()->get('search');

        if ($request->has('search')) {
            $request->session()->put('search', $request->input('search'));
        }

        if ($request->has('clear')) {
            $request->session()->forget('search');
            return redirect()->route('tabulka.index');
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->input('search');
            $query->where('tags', 'LIKE', "%$search%");
        }

        $tabulkas = $query->get()->map(function ($tabulka) {
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
            'tabulkas' => $tabulkas,
            'search' => $request->input('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $search = request('search');
        return view("tabulka.create", compact('search'));
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
            "tags" => "nullable|string|max:255",
        ]);

        Tabulka::create([
            "name" => $request->name,
            "description" => $request->description,
            "status" => $request->status == true ? 1:0,
            "tags" => $request->tags,
        ]);

        $search = $request->session()->get('search');
        if ($search) {
         return redirect()->route('tabulka.index', ['search' => $search])->with("status", "Úloha bola úspešne vytvorená");
        } else {
         return redirect()->route('tabulka.index')->with("status", "Úloha bola úspešne vytvorená");
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Tabulka $tabulka)
    {
        $search = request('search');
        return view("tabulka.show", compact('tabulka', 'search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabulka $tabulka)
    {
        $search = request('search');
        return view("tabulka.edit", compact('tabulka', 'search'));
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
            "tags" => "nullable|string|max:255",
        ]);

        $tabulka->update([
            "name" => $request->name,
            "description" => $request->description,
            "status" => $request->status == true ? 1:0,
            "tags" => $request->tags,
        ]);

        $search = $request->session()->get('search');
        if ($search) {
         return redirect()->route('tabulka.index', ['search' => $search])->with("status", "Úloha bola úspešne pozmenená");
        } else {
         return redirect()->route('tabulka.index')->with("status", "Úloha bola úspešne pozmenená");
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Tabulka $tabulka)
    {
        $tabulka->delete();

        $search = $request->session()->get('search');
        if ($search) {
         return redirect()->route('tabulka.index', ['search' => $search])->with("status", "Úloha bola úspešne odstránená");
        } else {
         return redirect()->route('tabulka.index')->with("status", "Úloha bola úspešne odstránená");
        }


    }
}
