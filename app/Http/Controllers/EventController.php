<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('location')->get();
        return response()->json($events);
    }


    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:50',
            'event_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'id_location' => 'required|exists:locations,id_location',
        ]);

        $event = Event::create([
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'id_location' => $request->id_location,
            'id_user' => Auth::id(),
        ]);

        return response()->json($event, 201);
    }

    public function show($id)
    {
        return Event::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'string|max:50',
            'event_description' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'id_location' => 'exists:locations,id_location',
            'id_user' => 'exists:users,id_user'
        ]);

        $event = Event::findOrFail($id);

        if ($request->has('event_name')) {
            $event->event_name = $request->event_name;
        }
        if ($request->has('event_description')) {
            $event->event_description = $request->event_description;
        }
        if ($request->has('start_date')) {
            $event->start_date = $request->start_date;
        }
        if ($request->has('end_date')) {
            $event->end_date = $request->end_date;
        }
        if ($request->has('id_location')) {
            $event->id_location = $request->id_location;
        }
        if ($request->has('id_user')) {
            $event->id_user = $request->id_user;
        }

        $event->save();

        return response()->json($event, 200);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
