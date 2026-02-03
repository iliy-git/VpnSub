@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('configs.index') }}">Конфиги</a></li>
                    <li class="breadcrumb-item active">{{ isset($config) ? 'Редактирование' : 'Создание' }}</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="mb-4">{{ isset($config) ? 'Редактировать конфигурацию' : 'Новая конфигурация' }}</h4>

                    <form action="{{ isset($config) ? route('configs.update', $config) : route('configs.store') }}" method="POST">
                        @csrf
                        @if(isset($config)) @method('PUT') @endif

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Название</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Например: Germany-VLESS-01"
                                   value="{{ old('name', $config->name ?? '') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Ссылка (URL)</label>
                            <textarea name="link"
                                      class="form-control @error('link') is-invalid @enderror"
                                      rows="3"
                                      placeholder="vless://... или https://..."
                                      required>{{ old('link', $config->link ?? '') }}</textarea>
                            @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Вставьте полную строку подключения или ссылку на файл.</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('configs.index') }}" class="btn btn-light px-4">Отмена</a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                {{ isset($config) ? 'Обновить данные' : 'Создать конфиг' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
