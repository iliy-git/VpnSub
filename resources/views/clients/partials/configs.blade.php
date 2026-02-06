<div class="card card-body bg-light border-0 shadow-none p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="small fw-bold mb-0"><i class="bi bi-server me-1"></i> Сервера</h6>
        <button class="btn btn-sm btn-outline-primary state-save"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#create-config-{{ $subscription->id }}">
            <i class="bi bi-plus-lg"></i>
        </button>
    </div>

    <div class="collapse mb-3 state-element" id="create-config-{{ $subscription->id }}">
        <div class="card card-body border-primary-subtle shadow-sm">
            <form method="POST" action="{{ route('subscriptions.configs.store', $subscription) }}">
                @csrf
                <input type="text" name="name" class="form-control form-control-sm mb-2" placeholder="Название" required>
                <textarea name="link" class="form-control form-control-sm mb-2" placeholder="vless://..." required></textarea>
                <button class="btn btn-sm btn-primary w-100">Создать и привязать</button>
            </form>
        </div>
    </div>

    <div class="list-group">
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
    </div>
</div>
