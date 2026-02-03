@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h4>{{ isset($subscription) ? 'Редактировать' : 'Новая' }} подписка</h4>
                <hr>
                <form action="{{ isset($subscription) ? route('subscriptions.update', $subscription) : route('subscriptions.store') }}" method="POST">
                    @csrf
                    @if(isset($subscription)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Название подписки</label>
                        <input type="text" name="name" class="form-control" value="{{ $subscription->name ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Доступные конфигурации</label>
                        <select name="config_ids[]" class="form-select" multiple size="8">
                            @foreach($configs as $config)
                                <option value="{{ $config->id }}"
                                    {{ (isset($selectedConfigs) && in_array($config->id, $selectedConfigs)) ? 'selected' : '' }}>
                                    {{ $config->name }} ({{ $config->link }})
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Удерживайте Ctrl (или Cmd), чтобы выбрать несколько.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('subscriptions.index') }}" class="btn btn-light">Отмена</a>
                        <button type="submit" class="btn btn-primary px-4 shadow">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
