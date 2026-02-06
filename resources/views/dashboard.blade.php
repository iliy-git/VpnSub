@extends('layouts.app')

@section('content')
    <div class="row g-4">
        <div class="col-12 mb-2">
            <h2 class="fw-bold">Главный пульт</h2>
            <p class="text-secondary text-opacity-75">Управление трафиком и доступом в один клик</p>
        </div>

        <div class="col-md-6">
            <div class="card p-4 h-100 border-0 shadow-lg">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3">
                        <i class="bi bi-gear-wide-connected text-primary h3 mb-0"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Конфигурации</h5>
                        <small class="text-muted">Всего: {{ \App\Models\Config::count() }}</small>
                    </div>
                </div>
                <p class="text-muted">Добавляйте новые серверы, VLESS, Trojan или Shadowsocks ключи.</p>
                <a href="{{ route('configs.index') }}" class="btn btn-primary mt-auto">Перейти к списку</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 h-100 border-0 shadow-lg">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 p-3 rounded-4 me-3">
                        <i class="bi bi-people-fill text-success h3 mb-0"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Подписки</h5>
                        <small class="text-muted">Активно: {{ \App\Models\Subscription::count() }}</small>
                    </div>
                </div>
                <p class="text-muted">Группируйте серверы и создавайте уникальные ссылки для клиентов.</p>
                <a href="{{ route('subscriptions.index') }}" class="btn btn-success text-white border-0 mt-auto" style="border-radius:10px; font-weight:600; background-color: #10b981;">Управлять доступом</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100 border-0 shadow-lg">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 p-3 rounded-4 me-3">
                        <i class="bi bi-people-fill text-success h3 mb-0"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Клиенты</h5>
                        <small class="text-muted">Активно: {{ \App\Models\Client::count() }}</small>
                    </div>
                </div>
                <p class="text-muted">Добавляйте клиентов и управляйте старыми.</p>
                <a href="{{ route('сlients.index') }}" class="btn btn-success text-white border-0 mt-auto" style="border-radius:10px; font-weight:600; background-color: #10b981;">Управлять доступом</a>
            </div>
        </div>
    </div>
@endsection
