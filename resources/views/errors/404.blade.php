<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 | Estamos trabajando en ello</title>
    @vite(['resources/css/app.css'])
    <style>
        :root {
            --overlay-start: #2f4858;
            --overlay-end: #1f2d3d;
            --card-bg: rgba(255, 255, 255, 0.92);
            --text-main: #1f2d3d;
            --text-muted: #5f6b77;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 1.5rem;
            background: linear-gradient(130deg, var(--overlay-start), var(--overlay-end));
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .status-wrap {
            width: min(680px, 100%);
            animation: reveal 0.5s ease-out;
        }

        .status-card {
            border: 0;
            border-radius: 1rem;
            background: var(--card-bg);
            box-shadow: 0 1rem 2.5rem rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .status-banner {
            height: 8px;
            background: linear-gradient(90deg, #00c0ef, #3c8dbc, #001f3f);
        }

        .status-body {
            padding: 2rem;
            text-align: center;
            color: var(--text-main);
        }

        .status-code {
            margin-bottom: 0.4rem;
            font-size: clamp(2.7rem, 8vw, 4.5rem);
            font-weight: 800;
            letter-spacing: 0.05em;
            line-height: 1;
        }

        .status-title {
            margin-bottom: 0.6rem;
            font-size: clamp(1.2rem, 3vw, 1.9rem);
            font-weight: 700;
        }

        .status-desc {
            margin: 0 auto 1.8rem;
            max-width: 46ch;
            color: var(--text-muted);
            font-size: 1.03rem;
        }

        .status-actions {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .status-note {
            margin-top: 1.2rem;
            font-size: 0.93rem;
            color: #6c757d;
        }

        @media (max-width: 576px) {
            .status-body {
                padding: 1.4rem;
            }

            .status-actions {
                flex-direction: column;
            }

            .status-actions .btn {
                width: 100%;
            }
        }

        @keyframes reveal {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <main class="status-wrap" role="main" aria-labelledby="status-title">
        <section class="card status-card">
            <div class="status-banner"></div>
            <div class="status-body">
                <p class="status-code">404</p>
                <h1 class="status-title" id="status-title">Estamos trabajando en ello</h1>
                <p class="status-desc">
                    La página que buscas no está disponible por ahora. Puede que haya cambiado de ruta
                    o que todavía esté en proceso de construcción.
                </p>

                <div class="status-actions">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home mr-1" aria-hidden="true"></i> Ir al inicio
                    </a>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                        <i class="fas fa-arrow-left mr-1" aria-hidden="true"></i> Volver
                    </button>
                </div>

                <p class="status-note">Si el problema persiste, inténtalo de nuevo en una semana crack.</p>
            </div>
        </section>
    </main>
</body>

</html>
