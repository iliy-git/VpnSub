<div class="sub-item-card p-3 mb-2 shadow-sm">
    <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">VLESS</span>
                <strong class="text-dark">{{ $subscription->name }}</strong>
            </div>
            <code class="text-muted small" style="font-size: 0.7rem;">{{ $subscription->token }}</code>
        </div>
        <div class="dropdown">
            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                <li><a class="dropdown-item small" href="#" data-bs-toggle="collapse" data-bs-target="#edit-sub-{{ $subscription->id }}"><i class="bi bi-pencil me-2"></i>Переименовать</a></li>
                <li><button class="dropdown-item small text-danger" onclick="return confirm('Удалить подписку?')"><i class="bi bi-trash me-2"></i>Удалить</button></li>
            </ul>
        </div>
    </div>

    <div class="d-flex gap-2 mb-3">
        <button class="btn btn-sm btn-outline-primary w-100 py-1" onclick="copyToClipboard('{{ route('client.subscription', $subscription->token) }}')">
            <i class="bi bi-clipboard me-1"></i> Ссылка
        </button>
        <button class="btn btn-sm btn-outline-dark w-100 py-1" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $subscription->id }}">
            <i class="bi bi-qr-code me-1"></i> QR
        </button>
    </div>

    <button class="btn btn-sm btn-light border w-100 fw-bold text-secondary" data-bs-toggle="collapse" data-bs-target="#sub-{{ $subscription->id }}">
        <i class="bi bi-server me-2"></i> Сервера подписки
    </button>

    <div class="collapse mt-2" id="edit-sub-{{ $subscription->id }}">
        <div class="p-2 bg-white rounded border">
            <form method="POST" action="{{ route('clients.subscriptions.update', [$client, $subscription]) }}">
                @csrf @method('PUT')
                <div class="input-group input-group-sm">
                    <input type="text" name="name" class="form-control" value="{{ $subscription->name }}">
                    <button class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="qrModal-{{ $subscription->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <div class="mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-4 p-2 d-inline-block mb-3">
                            <i class="bi bi-qr-code text-primary fs-4"></i>
                        </div>
                        <h6 class="fw-bold mb-1">{{ $subscription->name }}</h6>
                        <p class="text-muted small">Сканируйте для подключения</p>
                    </div>

                    <div class="qr-container p-3 bg-white border rounded-4 mb-3 shadow-sm">
                        {{-- Используем goqr.me с правильным urlencode --}}
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode(route('client.subscription', $subscription->token)) }}&margin=10"
                             alt="QR Code"
                             class="img-fluid rounded-3"
                             id="qrImage-{{ $subscription->id }}">
                    </div>

                    <div class="d-grid gap-2">
                        <a href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data={{ urlencode(route('client.subscription', $subscription->token)) }}"
                           download="QR_{{ $subscription->name }}.png"
                           target="_blank"
                           class="btn btn-primary rounded-3 py-2">
                            <i class="bi bi-download me-2"></i>Открыть оригинал
                        </a>
                        <button type="button" class="btn btn-light rounded-3 text-muted" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="collapse mt-2" id="sub-{{ $subscription->id }}">
        @include('clients.partials.configs', ['subscription' => $subscription])
    </div>
</div>
