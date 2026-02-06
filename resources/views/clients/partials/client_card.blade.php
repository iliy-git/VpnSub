<div class="card client-card border-0 shadow-sm h-100">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <div class="avatar-circle d-flex align-items-center justify-content-center me-3">
                    {{ mb_substr($client->name, 0, 1) }}
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">{{ $client->name }}</h6>
                    <small class="text-muted">{{ $client->phone ?? 'Без телефона' }}</small>
                </div>
            </div>
            <button class="btn btn-light btn-sm rounded-circle shadow-none border"
                    data-bs-toggle="modal"
                    data-bs-target="#editClientModal-{{ $client->id }}">
                <i class="bi bi-person-gear"></i>
            </button>
        </div>

        <div class="d-flex justify-content-between align-items-center bg-light rounded-3 p-2 mb-3">
            <span class="small fw-medium text-primary">
                <i class="bi bi-link-45deg"></i> {{ $client->subscriptions->count() }} подписки
            </span>
            <button class="btn btn-primary btn-sm rounded-3 px-3 shadow-none" data-bs-toggle="collapse" data-bs-target="#client-subs-{{ $client->id }}">
                Управлять <i class="bi bi-chevron-down ms-1"></i>
            </button>
        </div>

        <div class="collapse" id="client-subs-{{ $client->id }}">
            <div class="mt-3 pt-3 border-top">
                @include('clients.partials.subscriptions', ['client' => $client])
            </div>
        </div>
    </div>
    <div class="modal fade" id="editClientModal-{{ $client->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Профиль клиента</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('clients.update', $client) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-body py-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted">ФИО / Никнейм</label>
                                <input type="text" name="name" class="form-control rounded-3 bg-light border-0" value="{{ $client->name }}" required placeholder="Имя клиента">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted">Номер телефона</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3 text-muted"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="phone" class="form-control rounded-end-3 bg-light border-0" value="{{ $client->phone }}" placeholder="+7...">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted">Адрес проживания</label>
                                <input type="text" name="address" class="form-control rounded-3 bg-light border-0" value="{{ $client->address }}" placeholder="Город, улица, дом">
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted">Заметки / Доп. информация</label>
                                <textarea name="additional_info" class="form-control rounded-3 bg-light border-0" rows="3" placeholder="Любая важная информация о клиенте...">{{ $client->additional_info }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0 pb-4 justify-content-center">
                        <button type="button" class="btn btn-light rounded-3 px-4 fw-medium text-muted" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-5 shadow-sm">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
