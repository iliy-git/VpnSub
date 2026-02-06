@extends('layouts.app')

@section('content')
    <div class="col-12 col-lg-4 border-end bg-white p-3 overflow-auto">
        @foreach($clients as $c)
            <a href="{{ route('clients.show', $c) }}"
               class="list-group-item list-group-item-action rounded mb-2 {{ $c->id === $client->id ? 'active' : '' }}">
                {{ $c->name }}
            </a>
        @endforeach
    </div>

    <div class="col-12 col-lg-8 p-4 overflow-auto">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">{{ $client->name }}</h4>
                <small class="text-muted">ID #{{ $client->id }}</small>
            </div>
        </div>

        {{-- Подписки --}}
        <div class="card mb-3">
            <div class="card-header fw-bold">Подписки</div>
            <div class="card-body">
                @foreach($client->subscriptions as $subscription)
                    @include('clients.partials.subscription_clean', compact('subscription','client'))
                @endforeach
            </div>
        </div>

    </div>
@endsection
