<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; // Assuming you have an Admin model

class AdminController extends Controller
{
    // Display a listing of the resource (GET request)
    public function index()
    {
        // Fetch all admin resources
        $admins = Admin::all();
        return response()->json(['data' => $admins], 200);
    }

    // Store a newly created resource in storage (POST request)
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            // Add other fields and validation rules as needed
        ]);

        // Create a new admin
        $admin = Admin::create($validatedData);
        return response()->json(['data' => $admin], 201);
    }

    // Display the specified resource (GET request)
    public function show($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['error' => 'Admin not found'], 404);
        }

        return response()->json(['data' => $admin], 200);
    }

    // Update the specified resource in storage (PUT/PATCH request)
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['error' => 'Admin not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:admins,email,' . $id,
            // Add other fields and validation rules as needed
        ]);

        // Update the admin details
        $admin->update($validatedData);
        return response()->json(['data' => $admin], 200);
    }

    // Remove the specified resource from storage (DELETE request)
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['error' => 'Admin not found'], 404);
        }

        // Delete the admin
        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}
