@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-shield-lock text-primary me-2"></i>
                                Настройки SSL (HTTPS)
                            </h5>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Nginx Mode</span>
                        </div>
                    </div>

                    <div class="card-body p-4 pt-0">
                        <p class="text-muted small mb-4">
                            Вставьте содержимое ваших SSL-сертификатов ниже. После сохранения Nginx будет перезагружен автоматически.
                        </p>

                        <form action="{{ route('admin.ssl.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-secondary">Публичный сертификат (Certificate / fullchain.pem)</label>
                                    <textarea name="cert"
                                              class="form-control border-0 bg-light rounded-3 p-3 font-monospace"
                                              rows="8"
                                              placeholder="-----BEGIN CERTIFICATE-----"
                                              style="font-size: 0.85rem;">{{ $cert }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-bold text-secondary">Закрытый ключ (Private Key / privkey.pem)</label>
                                    <textarea name="key"
                                              class="form-control border-0 bg-light rounded-3 p-3 font-monospace"
                                              rows="8"
                                              placeholder="-----BEGIN PRIVATE KEY-----"
                                              style="font-size: 0.85rem;">{{ $key }}</textarea>
                                </div>

                                <div class="col-12">
                                    <hr class="my-4 opacity-25">
                                    <div class="d-flex gap-3">
                                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 shadow-sm">
                                            <i class="bi bi-save me-2"></i> Сохранить и применить
                                        </button>

                                        <button type="button"
                                                onclick="event.preventDefault(); document.getElementById('reload-form').submit();"
                                                class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                            <i class="bi bi-arrow-clockwise"></i> Только перезапуск
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form id="reload-form" action="{{ route('admin.ssl.reload') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-light rounded-4 border">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-info-circle me-3 fs-5"></i>
                        <div>
                            <strong>Совет:</strong> Если вы используете Cloudflare, выберите режим "Full (Strict)" и вставьте сюда Origin Certificate.
                            Пути в системе: <code>/etc/nginx/ssl/</code>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
