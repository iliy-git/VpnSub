<div class="mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Подписки клиента</h6>
        <button class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#create-subscription-{{ $client->id }}">
            + Создать подписку
        </button>
    </div>

    <div class="collapse mb-3" id="create-subscription-{{ $client->id }}">
        <div class="card p-3 border-primary shadow-sm">
            <form method="POST" action="{{ route('clients.subscriptions.storeNew', $client) }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Название (напр. Fast VPN)" required>
                    <button class="btn btn-sm btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>

    @foreach($client->subscriptions as $subscription)
        @include('clients.partials.subscription_card', ['client' => $client, 'subscription' => $subscription])
    @endforeach
</div>
