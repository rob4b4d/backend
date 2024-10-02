<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conductor; // Assuming you have a Conductor model

class ConductorController extends Controller
{
    // Display a listing of the resource (GET request)
    public function index()
    {
        // Fetch all conductor resources
        $conductors = Conductor::all();
        return response()->json(['data' => $conductors], 200);
    }

    // Store a newly created resource in storage (POST request)
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:conductors',
            // Add other fields and validation rules as needed
        ]);

        // Create a new conductor
        $conductor = Conductor::create($validatedData);
        return response()->json(['data' => $conductor], 201);
    }

    // Display the specified resource (GET request)
    public function show($id)
    {
        $conductor = Conductor::find($id);
        if (!$conductor) {
            return response()->json(['error' => 'Conductor not found'], 404);
        }

        return response()->json(['data' => $conductor], 200);
    }

    // Update the specified resource in storage (PUT/PATCH request)
    public function update(Request $request, $id)
    {
        $conductor = Conductor::find($id);
        if (!$conductor) {
            return response()->json(['error' => 'Conductor not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:conductors,email,' . $id,
            // Add other fields and validation rules as needed
        ]);

        // Update the conductor details
        $conductor->update($validatedData);
        return response()->json(['data' => $conductor], 200);
    }

    // Remove the specified resource from storage (DELETE request)
    public function destroy($id)
    {
        $conductor = Conductor::find($id);
        if (!$conductor) {
            return response()->json(['error' => 'Conductor not found'], 404);
        }

        // Delete the conductor
        $conductor->delete();
        return response()->json(['message' => 'Conductor deleted successfully'], 200);
    }
}
