<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
//    public function create()
//    {
//        return view('subscriptions.create');
//    }
//
//    public function store(Request $request)
//    {
//        $subscription = Subscription::create([
//            'name' => $request->validate([
//                'name' => 'required|string|max:255',
//            ])['name'],
//            'token' => Str::uuid(),
//        ]);
//
//        return redirect()
//            ->route('subscriptions.edit', $subscription)
//            ->with('success', 'Подписка создана');
//    }
//
//    public function edit(Subscription $subscription)
//    {
//        $subscription->load('configs');
//
//        return view('subscriptions.edit', compact('subscription'));
//    }

//    public function update(Request $request, Subscription $subscription)
//    {
//        $subscription->update(
//            $request->validate([
//                'name' => 'required|string|max:255',
//            ])
//        );
//
//        return back()->with('success', 'Подписка обновлена');
//    }
    // app/Http/Controllers/SubscriptionController.php

    public function addConfig(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ]);

        // Создаем конфиг и сразу привязываем через связь
        $subscription->configs()->create($validated);

        return back()->with('success', 'Сервер создан внутри подписки');
    }

    public function updateConfig(Request $request, Subscription $subscription, Config $config)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ]);

        $config->update($data);

        return back()->with('success', 'Данные сервера обновлены');
    }

    public function removeConfig(Subscription $subscription, Config $config)
    {
        // Удаляем сам объект из базы, а не просто отвязываем
        $config->delete();

        return back()->with('success', 'Сервер полностью удален');
    }
}

