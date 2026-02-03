<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configs = \App\Models\Config::all();
        return view('configs.index', compact('configs'));
    }

    public function create()
    {
        return view('configs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ]);

        \App\Models\Config::create($validated);
        return redirect()->route('configs.index')->with('success', 'Config created!');
    }

    public function edit(\App\Models\Config $config)
    {
        return view('configs.edit', compact('config'));
    }

    public function update(Request $request, \App\Models\Config $config)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ]);

        $config->update($validated);
        return redirect()->route('configs.index')->with('success', 'Config updated!');
    }
}
