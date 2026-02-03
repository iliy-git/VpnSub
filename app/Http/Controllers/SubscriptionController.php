<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Загружаем вместе с конфигами (eager loading), чтобы не было лишних запросов
        $subscriptions = Subscription::with('configs')->get();
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $configs = Config::all(); // Получаем все конфиги для выбора
        return view('subscriptions.create', compact('configs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'config_ids' => 'nullable|array',
        ]);

        // Добавляем уникальный случайный токен
        $subscription = Subscription::create([
            'name' => $validated['name'],
            'token' => Str::random(32),
        ]);

        if ($request->has('config_ids')) {
            $subscription->configs()->sync($request->config_ids);
        }

        return redirect()->route('subscriptions.index');
    }

    public function edit(Subscription $subscription)
    {
        $configs = Config::all();
        // Загружаем текущие ID привязанных конфигов, чтобы выделить их в селекте
        $selectedConfigs = $subscription->configs->pluck('id')->toArray();

        return view('subscriptions.edit', compact('subscription', 'configs', 'selectedConfigs'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'config_ids' => 'nullable|array',
            'config_ids.*' => 'exists:configs,id',
        ]);

        $subscription->update(['name' => $validated['name']]);

        // sync() удалит старые связи и добавит только новые выбранные
        $subscription->configs()->sync($request->config_ids ?? []);

        return redirect()->route('subscriptions.index')->with('success', 'Подписка обновлена');
    }
}
