<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConferenceController extends Controller
{
    public function register(Request $request, $id) // [CONFERENCE REGISTRATION]
    {
        $request->validate([
            'client_name' => 'required|string|max:255|regex:/^[a-zA-Z\s-]+$/',
            'client_surname' => 'required|string|max:255|regex:/^[a-zA-Z\s-]+$/',
            'client_email' => 'required|email|max:255',
        ]);

        $conferences = json_decode(file_get_contents(storage_path('conferences.json')), true);

        if (!isset($conferences[$id])) {
            return redirect()->back()->with('error', 'Conference not found.');
        }

        $conferences[$id]['registered_clients'][] = [
            'name' => $request->input('client_name'),
            'surname' => $request->input('client_surname'),
            'email' => $request->input('client_email'),
        ];

        file_put_contents(storage_path('conferences.json'), json_encode($conferences, JSON_PRETTY_PRINT));

        return redirect()->back()->with('success', 'You have successfully registered for the conference.');
    }

    public function create() // [GETS THE CREATE CONFERENCE VIEW]
    {
        return view('conferences.create');
    }

    public function store(Request $request) // [CREATES A NEW CONFERENCE]
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string|in:scheduled,completed,canceled',
        ]);

        $filePath = storage_path('conferences.json');

        if (!file_exists($filePath)) {
            return redirect()->route('conferences.index')->with('error', 'Conferences data file not found.');
        }

        $conferences = json_decode(file_get_contents($filePath), true);

        $newConference = [
            'id' => (string) Str::uuid(),
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'status' => $request->input('status'),
            'registered_clients' => [],
        ];

        $conferences[] = $newConference;

        if (file_put_contents($filePath, json_encode($conferences, JSON_PRETTY_PRINT)) === false) {
            return redirect()->route('conferences.index')->with('error', 'Error saving conference data.');
        }

        return redirect()->route('conferences.index')->with('success', 'Conference created successfully.');
    }

    public function edit($id) // [GETS A CONFERENCE DATA FOR EDITING]
    {
        $conferences = json_decode(file_get_contents(storage_path('conferences.json')), true);

        foreach ($conferences as $conference) {
            if ($conference['id'] == $id) {
                return view('conferences.edit', compact('conference'));
            }
        }

        return redirect()->route('conferences.index')->with('error', 'Conference not found.');
    }

    public function update(Request $request, $id) // [UPDATES A CONFERENCE]
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string|in:scheduled,completed,canceled',
        ]);

        $conferences = json_decode(file_get_contents(storage_path('conferences.json')), true);
        $index = array_search($id, array_column($conferences, 'id'));

        if ($index === false) {
            return redirect()->route('conferences.index')->with('error', 'Conference not found.');
        }

        $conferences[$index]['title'] = $request->input('title');
        $conferences[$index]['date'] = $request->input('date');
        $conferences[$index]['status'] = $request->input('status');

        file_put_contents(storage_path('conferences.json'), json_encode($conferences, JSON_PRETTY_PRINT));

        return redirect()->route('conferences.index')->with('success', 'Conference updated successfully.');
    }

    public function destroy($id) // [DELETES A CONFERENCE]
    {
        $conferences = json_decode(file_get_contents(storage_path('conferences.json')), true);

        foreach ($conferences as $index => $conference) {
            if ($conference['id'] == $id) {

                unset($conferences[$index]);
                break;
            }
        }

        if (!isset($conference)) {
            return redirect()->route('conferences.index')->with('error', 'Conference not found.');
        }

        $conferences = array_values($conferences);

        file_put_contents(storage_path('conferences.json'), json_encode($conferences, JSON_PRETTY_PRINT));

        return redirect()->route('conferences.index')->with('success', 'Conference deleted successfully.');
    }

    public function show($id) // [CONFERENCE LIST PREVIEW ROUTE]
    {
        $conferences = json_decode(file_get_contents(storage_path('conferences.json')), true);
        $conference = collect($conferences)->firstWhere('id', $id);

        if (!$conference) {
            return redirect()->route('conferences.index')->with('error', 'Conference not found.');
        }

        return view('conferences.show', compact('conference'));
    }

    public function index() // [CONFERENCE LISTING ROUTE]
    {
        $filePath = storage_path('conferences.json');

        if (file_exists($filePath)) {
            $json = file_get_contents($filePath);
            $conferences = json_decode($json, true);
        } else {
            $conferences = [];
        }

        return view('conferences.index', ['conferences' => $conferences]);
    }

    public function setUserRole(Request $request) // [POST ROUTE TO SAVE USER ROLE IN SESSION]
    {
        $request->validate([
            'role' => 'required|string|in:Client,Employee,Admin',
        ]);

        session(['user_role' => $request->role]);

        return redirect()->route('dashboard');
    }

    public function dashboard() // [ADMIN DASHBOARD ROUTE + RESTRICTED ACCESS]
    {
        if (session('user_role') !== 'Admin') {
            return redirect()->route('dashboard');
        }
        return view('admin.dashboard');
    }

    public function editRegisteredClient($conferenceId, $clientIndex) // [EDITS A REGISTERED CLIENT DATA]
    {

    }

    public function updateRegisteredClient(Request $request, $conferenceId, $clientIndex) // [UPDATES THE REGISTERED CLIENT DATA]
    {
        // 2. // 3.
    }
}
