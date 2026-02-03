@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Управление подписками</h3>
        <a href="{{ route('subscriptions.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Создать подписку
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                <tr>
                    <th class="ps-4">Название</th>
                    <th>Конфиги</th>
                    <th>Ссылка для клиента</th>
                    <th class="text-end pe-4">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscriptions as $sub)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">{{ $sub->name }}</div>
                            <small class="text-muted">ID: {{ $sub->id }}</small>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-soft-info text-info border border-info px-3">
                                {{ $sub->configs->count() }} шт.
                            </span>
                        </td>
                        <td>
                            <div class="input-group input-group-sm" style="max-width: 350px;">
                                <input type="text" class="form-control bg-light border-end-0"
                                       value="{{ route('client.subscription', $sub->token) }}"
                                       id="link-{{ $sub->id }}" readonly>
                                <button class="btn btn-outline-secondary border-start-0" type="button"
                                        onclick="copyLink('{{ $sub->id }}')" title="Копировать ссылку">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                                <button class="btn btn-outline-secondary" type="button"
                                        data-bs-toggle="modal" data-bs-target="#qrModal{{ $sub->id }}" title="Показать QR-код">
                                    <i class="bi bi-qr-code"></i>
                                </button>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm">
                                <a href="{{ route('subscriptions.edit', $sub) }}" class="btn btn-sm btn-outline-primary" title="Редактировать">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('subscriptions.destroy', $sub) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Вы уверены, что хотите удалить подписку?')" title="Удалить">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="qrModal{{ $sub->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header border-0 pb-0">
                                    <h6 class="modal-title fw-bold">{{ $sub->name }}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center p-4">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('client.subscription', $sub->token)) }}"
                                         alt="QR Code" class="img-fluid rounded shadow-sm mb-3">
                                    <p class="small text-muted mb-0">Отсканируйте в приложении</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="copyToast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2 text-success"></i> Ссылка успешно скопирована!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <style>
        .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
        .table > :not(caption) > * > * { padding: 1rem 0.5rem; }
    </style>

    <script>
        function copyLink(id) {
            const copyText = document.getElementById("link-" + id);
            copyText.select();
            navigator.clipboard.writeText(copyText.value);

            // Показываем Toast вместо Alert
            const toastEl = document.getElementById('copyToast');
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    </script>
@endsection
