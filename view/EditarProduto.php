<?php
session_start();
$produto = $_SESSION['produto'];
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px; /* Bordas arredondadas */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ffc107; /* Amarelo */
        }

        img {
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 5px;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        input[type="submit"] {
            background-color: #ffc107; /* Amarelo */
            color: white; /* Cor do texto branco */
            border: none; /* Remove borda padrão */
            border-radius: 10px; /* Bordas arredondadas */
        }

        input[type="submit"]:hover {
            background-color: #e0a800; /* Amarelo mais escuro */
        }

        .form-group label {
            font-weight: bold;
            color: #333; /* Cor do texto do label */
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '\menu.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Produto</h1>
        <form action="../controller/ProdutoController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="method" value="atualizar" />
            <input type="hidden" name="codigo" value="<?= $produto['codigo'] ?>" />

            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do Produto:</label>
                <input type="text" name="nome_produto" id="nome_produto" value="<?= $produto['nome'] ?>" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <input type="text" name="categoria" id="categoria" value="<?= $produto['categoria'] ?>" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço:</label>
                <input type="text" name="preco" id="preco" value="<?= $produto['preco'] ?>" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="imagem_atual" class="form-label">Imagem Atual:</label>
                <?php if (!empty($produto['imagem'])): ?>
                    <div>
                        <img src="../<?= $produto['imagem'] ?>" alt="Imagem do Produto" />
                    </div>
                <?php else: ?>
                    <p class="text-muted">Sem imagem cadastrada.</p>
                <?php endif; ?>
            </div>

            <div class="mb-3 form-group">
                <label for="imagem" class="form-label">Alterar Imagem:</label>
                <input type="file" name="imagem" id="imagem" class="form-control" />
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <input type="submit" value="Salvar Alterações" class="btn btn-primary" />
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+SO3+7p1Hg00v3p8fDNRcSvA8Htv/"
        crossorigin="anonymous"></script>
</body>

</html>