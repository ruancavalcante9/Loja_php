<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        body {
            background-color: #f4f7fa;
            padding-top: 50px; /* Ajusta o espaço superior */
        }

        .container {
            max-width: 400px; /* Limita a largura da caixa de login */
            margin: auto; /* Centraliza a caixa */
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #ffc107; /* Amarelo */
            border: none;
            color: white; /* Texto em branco */
        }

        .btn-primary:hover {
            background-color: #e0a800; /* Amarelo mais escuro */
        }

        .navbar {
            background-color: #007bff; /* Azul */
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: white;
        }

        .navbar-nav .nav-link:hover {
            color: #f8f9fa; /* Cor clara ao passar o mouse */
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '\menu.php'; ?>

    <div class="container">
        <form action="../controller/UsuarioController.php" method="POST">
            <fieldset class="card p-4 shadow-sm">
                <legend class="text-center mb-4">Login</legend>
                <input type="hidden" name="method" value="efetuarLogin" />
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" name="usuario" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" required />
                </div>

                <div class="d-grid gap-2 mb-4">
                    <input type="submit" value="Entrar" class="btn btn-primary" />
                </div>

                <div class="d-grid">
                    <a href="../view/CadastrarUsuario.php" class="btn btn-secondary">Cadastrar</a>
                </div>
            </fieldset>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+SO3+7p1Hg00v3p8fDNRcSvA8Htv/" crossorigin="anonymous"></script>
</body>

</html>