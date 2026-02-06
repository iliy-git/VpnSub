<div class="collapse" id="edit-client-{{ $client->id }}">
    <div class="card-body border-top bg-light">
        <form method="POST" action="{{ route('clients.update', $client) }}">
            @csrf @method('PUT')
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="small text-muted">Имя</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ $client->name }}" required>
                </div>
                <div class="col-md-4">
                    <label class="small text-muted">Телефон</label>
                    <input type="text" name="phone" class="form-control form-control-sm" value="{{ $client->phone }}">
                </div>
                <div class="col-md-4">
                    <label class="small text-muted">Адрес</label>
                    <input type="text" name="address" class="form-control form-control-sm" value="{{ $client->address }}">
                </div>
                <div class="col-12 mt-2">
                    <label class="small text-muted">Доп. информация</label>
                    <textarea name="additional_info" class="form-control form-control-sm" rows="2">{{ $client->additional_info }}</textarea>
                </div>
                <div class="col-12 text-end mt-2">
                    <button class="btn btn-sm btn-success px-3">Сохранить изменения</button>
                    <button type="button" class="btn btn-sm btn-light border" data-bs-toggle="collapse" data-bs-target="#edit-client-{{ $client->id }}">Отмена</button>
                </div>
            </div>
        </form>
    </div>
</div>
