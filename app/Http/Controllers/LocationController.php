<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:255',
            'location_description' => 'required|string',
            'location_category' => 'string|max:50|nullable',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        $location = Location::create([
            'location_name' => $request->location_name,
            'location_description' => $request->location_description,
            'location_category' => $request->location_category ?? 'General',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json($location, 201);
    }

    public function show($id)
    {
        return Location::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location_name' => 'string|max:255',
            'location_description' => 'string',
            'location_category' => 'string|max:50|nullable',
            'latitude' => 'numeric',
            'longitude' => 'numeric'
        ]);

        $location = Location::findOrFail($id);

        if ($request->has('location_name')) {
            $location->location_name = $request->location_name;
        }
        if ($request->has('location_description')) {
            $location->location_description = $request->location_description;
        }
        if ($request->has('location_category')) {
            $location->location_category = $request->location_category ?? 'General';
        }
        if ($request->has('latitude')) {
            $location->latitude = $request->latitude;
        }
        if ($request->has('longitude')) {
            $location->longitude = $request->longitude;
        }

        $location->save();

        return response()->json($location, 200);
    }

    public function destroy($id)
    {
        Location::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
