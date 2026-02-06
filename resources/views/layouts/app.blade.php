<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VPN Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --bg-main: #f8fafc;
            --card-border: #e2e8f0;
        }

        body {
            background-color: var(--bg-main);
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }

        /* Карточка клиента в стиле Modern SaaS */
        .client-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            transition: all 0.25s ease;
        }

        .client-card:hover {
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.05);
            border-color: var(--primary);
        }

        /* Компактный аватар */
        .avatar-circle {
            width: 42px;
            height: 42px;
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            border-radius: 12px;
            font-weight: 700;
        }

        /* Формы */
        .form-control {
            border-radius: 10px;
            border: 1px solid var(--card-border);
            padding: 0.6rem 0.8rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* Кнопки */
        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .sub-item-card {
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
        }
    </style>
</head>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="copyToast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle me-2 text-success"></i> Ссылка скопирована в буфер обмена!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<body class="bg-light">

<nav class="navbar navbar-light bg-white border-bottom px-4">
    <span class="navbar-brand fw-bold">VPN Admin</span>
</nav>

<div class="container-fluid">
    <div class="row vh-100">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Восстанавливаем состояние при загрузке
        const openElements = JSON.parse(localStorage.getItem('open_collapses')) || [];
        openElements.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                // Используем {toggle: false} чтобы просто показать, если сохранен
                new bootstrap.Collapse(el, { show: true });
            }
        });

        // 2. Слушаем события открытия/закрытия для сохранения
        document.addEventListener('shown.bs.collapse', function (event) {
            let openElements = JSON.parse(localStorage.getItem('open_collapses')) || [];
            if (!openElements.includes(event.target.id)) {
                openElements.push(event.target.id);
                localStorage.setItem('open_collapses', JSON.stringify(openElements));
            }
        });

        document.addEventListener('hidden.bs.collapse', function (event) {
            let openElements = JSON.parse(localStorage.getItem('open_collapses')) || [];
            openElements = openElements.filter(id => id !== event.target.id);
            localStorage.setItem('open_collapses', JSON.stringify(openElements));
        });

        // 3. ХИТРОСТЬ: При отправке формы удаляем её ID из памяти,
        // чтобы после редиректа она была закрыта
        document.addEventListener('submit', function (event) {
            const collapseParent = event.target.closest('.collapse');
            if (collapseParent) {
                let openElements = JSON.parse(localStorage.getItem('open_collapses')) || [];
                openElements = openElements.filter(id => id !== collapseParent.id);
                localStorage.setItem('open_collapses', JSON.stringify(openElements));
            }
        });
    });
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Находим элемент тоста
            const toastEl = document.getElementById('copyToast');

            // Инициализируем Bootstrap Toast
            const toast = new bootstrap.Toast(toastEl, {
                delay: 3000 // Исчезнет через 3 секунды
            });

            // Показываем его
            toast.show();
        }).catch(err => {
            console.error('Ошибка копирования: ', err);
        });
    }
</script>
</body>
</html>
