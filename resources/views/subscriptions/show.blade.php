@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">{{ $subscription->name }}</h4>
                <code class="text-muted">{{ $subscription->token }}</code>
            </div>

            <a href="{{ route('clients.show', $client) }}"
               class="btn btn-light btn-sm">
                ← Назад к клиенту
            </a>
        </div>

        <div class="row g-3">
            @forelse($subscription->configs as $config)
                <div class="col-12">
                    {{-- тут позже будет server_card --}}
                    <div class="bg-white rounded-4 p-3 border">
                        <div class="fw-semibold">{{ $config->name }}</div>
                        <code class="small text-muted">{{ $config->link }}</code>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    Серверов пока нет
                </div>
            @endforelse
        </div>

    </div>
@endsection
