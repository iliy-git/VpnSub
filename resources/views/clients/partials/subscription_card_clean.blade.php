<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body p-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <div class="subscription-name-wrapper"
                     data-id="{{ $subscription->id }}"
                     data-update-url="{{ route('clients.subscriptions.update', [$client, $subscription]) }}">

        <span class="subscription-name fw-bold">
            {{ $subscription->name }}
        </span>

                        <input type="text"
                               class="form-control form-control-sm subscription-name-input d-none"
                               value="{{ $subscription->name }}">
                </div>
                <code class="small text-muted">{{ $subscription->token }}</code>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-light border-0" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li>
                        <button class="dropdown-item small" data-bs-toggle="modal" data-bs-target="#renameSub-{{ $subscription->id }}">
                            <i class="bi bi-pencil me-2"></i>Переименовать
                        </button>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('clients.subscriptions.destroy', [$client, $subscription]) }}">
                            @csrf @method('DELETE')
                            <button class="dropdown-item small text-danger" onclick="return confirm('Удалить подписку?')">
                                <i class="bi bi-trash me-2"></i>Удалить
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex gap-2 mb-3">
            <button class="btn btn-sm btn-outline-primary w-100"
                    onclick="copyToClipboard('{{ route('client.subscription', $subscription->token) }}')">
                <i class="bi bi-clipboard me-1"></i> Ссылка
            </button>
            <button class="btn btn-sm btn-outline-dark w-100" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $subscription->id }}">
                <i class="bi bi-qr-code me-1"></i> QR
            </button>
        </div>


        {{-- Servers --}}
        <div>
            <div class="fw-semibold small text-muted mb-2">Сервера</div>

            @forelse($subscription->configs as $conf)
                <div class="mb-1">
                    <div class="list-group-item d-flex justify-content-between align-items-center p-2 bg-white border rounded shadow-sm">
                        <span class="small fw-medium">{{ $conf->name }}</span>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-light border p-1 state-save"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#edit-config-{{ $conf->id }}">
                                <i class="bi bi-pencil text-secondary"></i>
                            </button>

                            <form method="POST" action="{{ route('subscriptions.configs.destroy', [$subscription, $conf]) }}" onsubmit="return confirm('Удалить?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border p-1 text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="collapse mt-1 state-element" id="edit-config-{{ $conf->id }}">
                        <div class="card card-body border-secondary shadow-sm bg-white">
                            <form method="POST" action="{{ route('subscriptions.configs.update', [$subscription, $conf]) }}">
                                @csrf @method('PUT')
                                <input type="text" name="name" class="form-control form-control-sm mb-2" value="{{ $conf->name }}" required>
                                <textarea name="link" class="form-control form-control-sm mb-2" required>{{ $conf->link }}</textarea>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-success flex-grow-1">Сохранить</button>
                                    <button type="button" class="btn btn-sm btn-light border" data-bs-toggle="collapse" data-bs-target="#edit-config-{{ $conf->id }}">Отмена</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <small class="text-muted text-center py-2 border rounded border-dashed bg-white">Пусто</small>
            @endforelse


            <button class="btn btn-sm btn-primary w-100 mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addConfigModal-{{ $subscription->id }}">
                + Добавить сервер
            </button>
        </div>
    </div>
</div>

{{-- Rename modal --}}
<div class="modal fade" id="renameSub-{{ $subscription->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('clients.subscriptions.update', [$client, $subscription]) }}" class="modal-content rounded-4 border-0 shadow">
            @csrf @method('PUT')
            <div class="modal-header border-0">
                <h6 class="fw-bold">Переименовать подписку</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control" value="{{ $subscription->name }}" required autofocus>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-primary w-100">Сохранить</button>
            </div>
        </form>
    </div>
</div>

{{-- QR modal --}}
<div class="modal fade" id="qrModal-{{ $subscription->id }}" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-body text-center">
                <img class="img-fluid rounded-3"
                     src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode(route('client.subscription', $subscription->token)) }}">
            </div>
        </div>
    </div>
</div>
{{-- Add server modal --}}
<div class="modal fade" id="addConfigModal-{{ $subscription->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST"
              action="{{ route('subscriptions.configs.store', $subscription) }}"
              class="modal-content rounded-4 border-0 shadow">
            @csrf

            <div class="modal-header border-0">
                <h6 class="fw-bold mb-0">Добавить сервер</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small text-muted">Название</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Конфиг / ссылка</label>
                    <textarea name="link" class="form-control" rows="3" required></textarea>
                </div>
            </div>

            <div class="modal-footer border-0">
                <button class="btn btn-primary w-100">
                    Добавить
                </button>
            </div>
        </form>
    </div>
</div>

