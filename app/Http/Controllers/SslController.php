<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SslController extends Controller
{
    public function index()
    {
        $cert = File::exists('/etc/nginx/ssl/fullchain.pem') ? File::get('/etc/nginx/ssl/fullchain.pem') : '';
        $key = File::exists('/etc/nginx/ssl/privkey.pem') ? File::get('/etc/nginx/ssl/privkey.pem') : '';
        return view('admin.ssl', compact('cert', 'key'));
    }

    public function store(Request $request)
    {
        $path = '/etc/nginx/ssl';

        // Сохраняем файлы прямо в смонтированный объем
        File::put($path . '/fullchain.pem', $request->cert);
        File::put($path . '/privkey.pem', $request->key);

        // Даем команду Nginx перезагрузиться
        shell_exec("docker exec vpn-admin-nginx nginx -s reload");

        return back()->with('success', 'Настройки применены!');
    }
    public function reload()
    {
        // Отправляем сигнал Nginx перечитать конфиги
        shell_exec("docker exec vpn-admin-nginx nginx -s reload");

        return back()->with('success', 'Веб-сервер Nginx успешно перезагружен!');
    }
}
