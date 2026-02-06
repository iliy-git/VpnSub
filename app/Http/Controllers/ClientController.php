<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function show($token)
    {
        $subscription = Subscription::with(['configs', 'clients'])
            ->where('token', $token)
            ->firstOrFail();

        $sortedConfigs = $subscription->configs->sortByDesc(
            fn ($config) => str_contains($config->name, '[Fast]')
        );

        // Данные трафика для прогресс-бара
        $totalBytes = 500 * 1024 * 1024 * 1024;
        $usedBytes = 0;
        $subInfo = "upload=0; download={$usedBytes}; total={$totalBytes}; expire=" . ($subscription->expires_at?->timestamp ?? 0);

        $lines = [];
        $lines[] = "👋 Привет, " . $subscription->name . "!";
        $lines[] = "━━━━━━━━━━━━━━━━━━━━";

        foreach ($sortedConfigs as $config) {
            $baseLink = explode('#', $config->link)[0];
            $nameFromDb = $config->name;

            $isFast = str_contains($nameFromDb, '[Fast]');

            // Получаем флаг страны для левой стороны
            $flag = $this->getCountryFlag($nameFromDb);
            $country = $this->getRussianCountry($nameFromDb);

            // Устанавливаем статус: Ракета для Турбо, Белый флаг для Скрытного
            $statusIcon = $isFast ? "🚀" : "🏳️";
            $statusText = $isFast ? "Турбо" : "Скрытный";

            for ($i = 1; $i <= 2; $i++) {
                // Формат: [Флаг страны] Страна | [Белый флаг] Скрытный №1
                $prettyName = "{$flag} {$country} | {$statusIcon} {$statusText} №{$i}";
                $lines[] = $baseLink . '#' . rawurlencode($prettyName);
            }
        }

        $lines[] = "━━━━━━━━━━━━━━━━━━━━";

        $decoratedName = "💎 ". mb_strtoupper($subscription->name);

        $content = base64_encode(implode("\n", $lines));

        return response($content)
            ->header('Content-Type', 'text/plain; charset=utf-8')
            ->header('Subscription-Userinfo', $subInfo) // Полоска трафика

            // Украшенный заголовок группы в списке подписок
            ->header('Profile-Title', $decoratedName)

            // Название, которое отобразится в самом верху при выборе
            ->header('X-Config-Name', "🛡️ " . $subscription->name . " [АКТИВЕН]");
    }

    private function getCountryFlag($name) {
        $name = mb_strtolower($name);
        // Возвращаем стандартные флаги для левой части списка
        if (str_contains($name, 'россия') || str_contains($name, 'москва')) return "🇷🇺";
        if (str_contains($name, 'финлянд')) return "🇫🇮";
        if (str_contains($name, 'герман')) return "🇩🇪";
        if (str_contains($name, 'нидерланд')) return "🇳🇱";
        if (str_contains($name, 'сша') || str_contains($name, 'usa')) return "🇺🇸";

        return "🌐";
    }

    private function getRussianCountry($name) {
        $name = mb_strtolower($name);
        if (str_contains($name, 'москва')) return "Россия (МСК)";
        if (str_contains($name, 'россия')) return "Россия";
        if (str_contains($name, 'финлянд')) return "Финляндия";

        return ucfirst(trim(str_replace('[Fast]', '', $name)));
    }
}
