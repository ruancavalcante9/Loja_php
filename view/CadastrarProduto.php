<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Cadastrar Produto</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
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

      input[type="submit"] {
         background-color: #ffc107; /* Amarelo */
         color: white; /* Cor do texto branco */
         border: none; /* Remove borda padrão */
      }

      input[type="submit"]:hover {
         background-color: #e0a800; /* Amarelo mais escuro */
      }

      .form-control {
         border-radius: 10px; /* Bordas arredondadas para os inputs */
      }

      label {
         color: #333; /* Cor do texto do label */
      }
   </style>
</head>

<body>
   <?php
   include __DIR__ . '\menu.php';
   ?>
   <div class="container mt-5">
      <h1 class="text-center mb-4">Cadastrar Produto</h1>
      <form action="../controller/ProdutoController.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="method" value="salvar" />
         <div class="mb-3">
            <input type="text" name="nome_produto" placeholder="Nome do produto" class="form-control" required />
         </div>
         <div class="mb-3">
            <input type="text" name="categoria" placeholder="Categoria" class="form-control" required />
         </div>
         <div class="mb-3">
            <input type="text" name="preco" placeholder="Preço" class="form-control" required />
         </div>
         <div class="mb-3">
            <label for="imagem_produto">Imagem do Produto</label>
            <input type="file" name="imagem" class="form-control" accept="image/*" />
         </div>
         <div class="d-grid gap-2 col-6 mx-auto">
            <input type="submit" value="Cadastrar" class="btn btn-primary" />
         </div>
      </form>
   </div>
</body>

</html>