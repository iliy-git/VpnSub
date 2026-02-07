<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ClientManagerController extends Controller
{
    public function index()
    {
        $clients = Client::with('subscriptions.configs')->get();
        $subscriptions = Subscription::all();
        return view('clients.index', compact('clients', 'subscriptions'));
    }


    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
        ]);

        Client::create($data);

        return back()->with('success', 'Клиент успешно создан');
    }

    public function show(Client $client)
    {
        $client->load([
            'subscriptions.configs'
        ]);

        return view('clients.show', compact('client'));
    }


    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
        ]);

        $client->update($data);

        return back()->with('success', 'Данные клиента обновлены');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Клиент удалён');
    }
}

