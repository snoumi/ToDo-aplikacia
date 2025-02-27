<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tabulka;
use Illuminate\Http\Request;

class TabulkaApiController extends Controller
{
    public function index()
    {
        return Tabulka::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
            "status" => "nullable|boolean",
            "tags" => "nullable|string|max:255",
        ]);

        $tabulka = Tabulka::create($validated);

        return response()->json($tabulka, 201);
    }

    public function show(Tabulka $tabulka)
    {
        return $tabulka;
    }

    public function update(Request $request, Tabulka $tabulka)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
            "status" => "nullable|boolean",
            "tags" => "nullable|string|max:255",
        ]);

        $tabulka->update($validated);

        return response()->json($tabulka, 200);
    }

    public function destroy(Tabulka $tabulka)
    {
        $tabulka->delete();

        return response()->json(null, 204);
    }
}
