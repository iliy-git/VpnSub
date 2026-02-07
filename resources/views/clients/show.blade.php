@extends('layouts.app')

@section('content')
    <div class="container py-4">
        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <a href="{{ route('clients.index') }}" class="text-muted small">← Клиенты</a>
                <h3 class="fw-bold mb-0">{{ $client->name }}</h3>
                <div class="text-muted small">
                    {{ $client->phone ?? 'Без телефона' }} · {{ $client->address ?? 'Без адреса' }}
                </div>
            </div>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editClientModal">
                Редактировать
            </button>
        </div>

        {{-- Subscriptions --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Подписки</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createSubscriptionModal">
                + Создать подписку
            </button>
        </div>

        <div class="row g-3">
            @forelse($client->subscriptions as $subscription)
                <div class="col-12 col-lg-6">
                    @include('clients.partials.subscription_card_clean', ['client' => $client, 'subscription' => $subscription])
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center p-5 bg-white rounded-4 border">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <div class="mt-2">Подписок пока нет</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Edit client modal --}}
    @include('clients.partials.edit_client_modal', ['client' => $client])

    {{-- Create subscription modal --}}
    <div class="modal fade" id="createSubscriptionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('clients.subscriptions.storeNew', $client) }}" class="modal-content rounded-4 border-0 shadow">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Новая подписка</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Название подписки" required autofocus>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-primary w-100">Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection
