<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function show($token)
    {
        $subscription = \App\Models\Subscription::where('token', $token)->firstOrFail();

        $content = $subscription->configs->pluck('link')->implode("\n");

        return response($content)
            ->header('Content-Type', 'text/plain; charset=utf-8')
            // Этот заголовок задает имя подписки в приложении (Nekoray, V2Ray и др.)
            ->header('profile-title', $subscription->name)
            // Дополнительный заголовок для совместимости
            ->header('Subscription-Userinfo', "name=" . urlencode($subscription->name));
    }
}
