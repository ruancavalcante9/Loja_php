<?php

namespace controller;
require '..\model\Produto.php';
require '..\model\ProdutoDAO.php';

use model\Produto;
use model\ProdutoDAO;

session_start();  // Inicializa a sessão no início do controlador

if (
    $_SERVER['REQUEST_METHOD'] == 'GET'
    && isset($_GET['method'])
) {
    $method = $_GET['method'];
    if (method_exists('controller\ProdutoController', $method)) {
        $produtoController = new ProdutoController();
        $produtoController->$method($_GET);
    } else {
        echo "Método não existe.";
    }
} else if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['method'])
) {
    $method = $_POST['method'];
    if (method_exists('controller\ProdutoController', $method)) {
        $produtoController = new ProdutoController();
        $produtoController->$method($_POST);
    } else {
        echo "Método não existe";
    }
}

class ProdutoController {

    public function index() {
        // Função index (não utilizada no momento)
    }

    public function salvar() {
        $nome = filter_input(INPUT_POST, "nome_produto");
        $categoria = filter_input(INPUT_POST, "categoria");
        $preco = filter_input(INPUT_POST, "preco");

        // Lida com o upload de imagem
        $imagem = null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $novoNome = uniqid() . "." . $extensao;
            $diretorio = "../uploads/"; // Certifique-se de que esse diretório existe
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $novoNome)) {
                $imagem = "uploads/" . $novoNome;
            }
        }

        $produto = new Produto();
        $produto->setNome($nome);
        $produto->setCategoria($categoria);
        $produto->setPreco($preco);
        $produto->setImagem($imagem);

        $produtoDAO = new ProdutoDAO();
        $msg = $produtoDAO->salvar($produto);
        $_SESSION['msg'] = $msg;
        header('location: ../view/ListarProduto.php');
        exit;
    }

    public function getTodos() {
        unset($_SESSION['msg']);
        $produtoDAO = new ProdutoDAO();
        return $produtoDAO->getTodos();
    }

    public function iniciarEditar() {
        $codigo = filter_input(INPUT_GET, "codigo");
        $produtoDAO = new ProdutoDAO();
        $produto = $produtoDAO->getPorCodigo($codigo);
        $_SESSION['produto'] = $produto;
        header('location: ../view/EditarProduto.php');
        exit;
    }

    public function atualizar() {
        $codigo = filter_input(INPUT_POST, "codigo");
        $nome = filter_input(INPUT_POST, "nome_produto");
        $categoria = filter_input(INPUT_POST, "categoria");
        $preco = filter_input(INPUT_POST, "preco");

        // Lida com o upload de imagem
        $imagem = null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $novoNome = uniqid() . "." . $extensao;
            $diretorio = "../uploads/"; // Certifique-se de que esse diretório existe
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $novoNome)) {
                $imagem = "uploads/" . $novoNome;
            }
        }

        $produto = new Produto();
        $produto->setCodigo($codigo);
        $produto->setNome($nome);
        $produto->setCategoria($categoria);
        $produto->setPreco($preco);
        if ($imagem) {
            $produto->setImagem($imagem);
        }

        $produtoDAO = new ProdutoDAO();
        $msg = $produtoDAO->atualizar($produto);
        $_SESSION['msg'] = $msg;
        header('location: ../view/ListarProduto.php');
        exit;
    }

    public function excluir() {
        $codigo = filter_input(INPUT_GET, "codigo");
        $produtoDAO = new ProdutoDAO();

        $produto = new Produto();
        $produto->setCodigo($codigo);
        $msg = $produtoDAO->excluir($produto);
        $_SESSION['msg'] = $msg;
        header('location: ../view/ListarProduto.php');
        exit;
    }
}
?>
