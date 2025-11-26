<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(__('Error')); ?> <?php echo $__env->yieldContent('code'); ?> - <?php echo e(config('app.name')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg: #f8fafc;
            --text: #1e293b;
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --gray: #64748b;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #0f172a;
                --text: #e2e8f0;
                --gray: #94a3b8;
            }
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.6;
        }

        .container {
            text-align: center;
            padding: 2rem;
            max-width: 640px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 9rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            line-height: 1;
            letter-spacing: -0.05em;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 1rem 0;
            color: var(--text);
        }

        .message {
            font-size: 1.25rem;
            color: var(--gray);
            margin-bottom: 2rem;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text);
            border: 2px solid var(--gray);
        }

        .btn-secondary:hover {
            background: rgba(100, 116, 139, 0.1);
            border-color: var(--text);
        }

        .icon {
            font-size: 4rem;
            color: #e11d48;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        footer {
            margin-top: 4rem;
            font-size: 0.875rem;
            color: var(--gray);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>

        <h1 class="error-code"><?php echo $__env->yieldContent('code', '500'); ?></h1>

        <h2 class="title"><?php echo $__env->yieldContent('title', '¡Oops! Algo salió mal'); ?></h2>

        <p class="message">
            <?php echo $__env->yieldContent('message', 'Hemos encontrado un problema inesperado. Nuestro equipo ya está trabajando en solucionarlo.'); ?>
        </p>

        <div class="actions">
            <a href="<?php echo e(url()->previous() !== url()->current() ? url()->previous() : route('home') ?? '/'); ?>"
                class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Volver atrás
            </a>

            <a href="<?php echo e(route('home') ?? '/'); ?>" class="btn btn-secondary">
                <i class="fas fa-home"></i>
                Ir al inicio
            </a>
        </div>

        <?php if(config('app.debug') && auth()->check()): ?>
            <details style="margin-top: 3rem; text-align: left; font-size: 0.875rem; color: var(--gray);">
                <summary style="cursor: pointer; margin-bottom: 1rem;">Detalles técnicos (solo en desarrollo)</summary>
                <pre style="background: rgba(0,0,0,0.05); padding: 1rem; border-radius: 0.5rem; overflow-x: auto; text-align: left;">
        <?php echo $__env->yieldContent('exception'); ?>
                </pre>
            </details>
        <?php endif; ?>

        <footer>
            &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?> — Si el problema persiste, contáctanos.
        </footer>
    </div>
</body>

</html>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/errors/layout.blade.php ENDPATH**/ ?>