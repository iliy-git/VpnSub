@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Конфигурации VPN</h3>
        <a href="{{ route('configs.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Добавить конфиг
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Название</th>
                    <th>Ссылка</th>
                    <th>Дата создания</th>
                    <th class="text-end pe-4">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($configs as $config)
                    <tr>
                        <td class="ps-4 text-muted">{{ $config->id }}</td>
                        <td><strong>{{ $config->name }}</strong></td>
                        <td>
                            <code class="text-primary bg-light px-2 py-1 rounded">{{ Str::limit($config->link, 40) }}</code>
                            <a href="{{ $config->link }}" target="_blank" class="ms-1 text-muted"><i class="bi bi-box-arrow-up-right"></i></a>
                        </td>
                        <td>{{ $config->created_at->format('d.m.Y') }}</td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm">
                                <a href="{{ route('configs.edit', $config) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('configs.destroy', $config) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить этот конфиг?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Конфигурации пока не добавлены.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
