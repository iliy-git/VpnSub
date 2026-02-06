<div class="collapse mb-3" id="create-client-form">
    <div class="card p-3 shadow-sm border-0">
        <form method="POST" action="{{ route('clients.store') }}">
            @csrf
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">ФИО / Никнейм</label>
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Иван Иванов" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Телефон</label>
                    <input type="text" name="phone" class="form-control form-control-sm" placeholder="+7...">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Адрес</label>
                    <input type="text" name="address" class="form-control form-control-sm" placeholder="Город, улица...">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Доп. информация</label>
                    <textarea name="additional_info" class="form-control form-control-sm" rows="2" placeholder="Заметки о клиенте..."></textarea>
                </div>
            </div>
            <button class="btn btn-primary btn-sm mt-3 px-4">Создать клиента</button>
        </form>
    </div>
</div>
