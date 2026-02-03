@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <h2 class="h4">Добро пожаловать в админ-панель!</h2>
                <p class="text-muted">Здесь вы можете управлять VPN-конфигурациями и подписками пользователей.</p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-primary text-white p-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <h5>Конфиги</h5>
                                <i class="bi bi-gear-fill h3"></i>
                            </div>
                            <a href="{{ route('configs.index') }}" class="text-white text-decoration-none">Перейти к списку →</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-success text-white p-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <h5>Подписки</h5>
                                <i class="bi bi-person-check-fill h3"></i>
                            </div>
                            <a href="{{ route('subscriptions.index') }}" class="text-white text-decoration-none">Управлять →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
