@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-0">Клиенты</h2>
                <p class="text-muted small mb-0">Управление доступом и конфигурациями</p>
            </div>

            <div class="d-flex gap-2">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" id="clientSearch" class="form-control ps-5 shadow-sm border-0" placeholder="Поиск клиента..." style="min-width: 250px;">
                </div>
                <button class="btn btn-primary px-3 shadow-sm" data-bs-toggle="collapse" data-bs-target="#create-client-form">
                    <i class="bi bi-plus-lg me-1"></i> Новый клиент
                </button>
            </div>
        </div>

        @include('clients.partials.create')

        <div class="row g-3" id="clientsGrid">
            @foreach($clients as $client)
                <div class="col-12 col-md-6 col-xl-4">
                    @include('clients.partials.client_card', ['client' => $client])
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.getElementById('clientSearch').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let cards = document.querySelectorAll('.col-12.col-md-6.col-xl-4');

            cards.forEach(card => {
                let name = card.querySelector('h6').innerText.toLowerCase();
                card.style.display = name.includes(filter) ? "" : "none";
            });
        });
    </script>
@endsection
