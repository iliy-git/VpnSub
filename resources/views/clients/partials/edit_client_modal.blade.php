<div class="modal fade" id="editClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('clients.update', $client) }}"
              class="modal-content border-0 shadow-lg rounded-4">
            @csrf
            @method('PUT')

            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Редактировать клиента</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body py-4">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Имя</label>
                        <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Телефон</label>
                        <input type="text" name="phone" class="form-control" value="{{ $client->phone }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Адрес</label>
                        <input type="text" name="address" class="form-control" value="{{ $client->address }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Доп. информация</label>
                        <textarea name="additional_info" class="form-control" rows="3">{{ $client->additional_info }}</textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary px-4">Сохранить</button>
            </div>
        </form>
    </div>
</div>
