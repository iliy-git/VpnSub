<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionConfigController extends Controller
{
    public function store(Request $request, Subscription $subscription)
    {
        $subscription->configs()->create(
            $request->validate([
                'name' => 'required|string|max:255',
                'link' => 'required|string',
            ])
        );

        return back()->with('success', 'Конфиг добавлен');
    }

    public function update(Request $request, Subscription $subscription, Config $config)
    {
        $config->update(
            $request->validate([
                'name' => 'required|string|max:255',
                'link' => 'required|string',
            ])
        );

        return back()->with('success', 'Конфиг обновлён');
    }

    public function destroy(Subscription $subscription, Config $config)
    {
        $config->delete();

        return back()->with('success', 'Конфиг удалён');
    }
}
