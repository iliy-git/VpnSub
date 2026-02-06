<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ClientSubscriptionController extends Controller
{
    // Привязка подписки к клиенту
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);

        $client->subscriptions()->syncWithoutDetaching($request->subscription_id);

        return back()->with('success', 'Подписка добавлена клиенту');
    }

    // Отвязка подписки от клиента
    public function destroy(Client $client, Subscription $subscription)
    {
        $client->subscriptions()->detach($subscription->id);

        return back()->with('success', 'Подписка удалена');
    }
    public function storeNew(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Создаем новую подписку с уникальным токеном
        $subscription = \App\Models\Subscription::create([
            'name' => $validated['name'],
            'token' => \Illuminate\Support\Str::uuid(),
        ]);

        // Привязываем к клиенту
        $client->subscriptions()->attach($subscription->id);

        return back()->with('success', 'Подписка создана и привязана к клиенту');
    }
    public function update(Request $request, Client $client, Subscription $subscription)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            // 'config_ids' => 'array', <-- убери это
        ]);

        $subscription->update(['name' => $data['name']]);

        // $subscription->configs()->sync($request->config_ids); <-- УДАЛИ ЭТУ СТРОКУ

        return back()->with('success', 'Название обновлено');
    }


}
