<?php
namespace controller;
require '../model/Usuario.php';
require '../model/UsuarioDAO.php';
require_once '../model/Conexao.php';

use model\Usuario;
use model\UsuarioDAO;
use model\Conexao;
use \PDO;
use \Exception;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['method'])) {
    $method = $_GET['method'];
    if (method_exists('controller\UsuarioController', $method)) {
        $usuarioController = new UsuarioController();
        $usuarioController->$method($_GET);
    } else {
        echo "Método não existe.";
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method'])) {
    $method = $_POST['method'];
    if (method_exists('controller\UsuarioController', $method)) {
        $usuarioController = new UsuarioController();
        if ($method == 'efetuarLogin') {
            $usuarioController->$method($_POST['usuario'], $_POST['senha']);
        } else {
            $usuarioController->$method($_POST);
        }
    } else {
        echo "Método não existe";
    }
}

class UsuarioController {
    public function index() {}

    public function efetuarLogin($usuario, $senha) {
        session_start();
        $user = $this->validarLogin($usuario, $senha);
        if ($user) {
            $_SESSION['user_id'] = $user->getId();
            header("Location: ../view/ListarProduto.php");
            exit();
        } else {
            echo "Usuário ou senha inválidos.";
        }
    }

    private function validarLogin($usuario, $senha) {
        $conexao = new Conexao();
        $connection = $conexao->getConnection();
        $SQL = 'SELECT * FROM usuarios WHERE nome = :usuario AND senha = :senha';
        $stmt = $connection->prepare($SQL);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            $user = new Usuario();
            $user->setId($resultado['id']);
            $user->setNome($resultado['nome']);
            $user->setEmail($resultado['email']);
            $user->setSenha($resultado['senha']);
            return $user;
        } else {
            return false;
        }
    }

    public function salvar() {
        try {
            $nome = filter_input(INPUT_POST, "nome");
            $email = filter_input(INPUT_POST, "email");
            $senha = filter_input(INPUT_POST, "senha");
    
            $usuario = new Usuario();
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setSenha($senha);
    
            $usuarioDAO = new UsuarioDAO();
            $msg = $usuarioDAO->salvar($usuario);
    
            session_start();
            $_SESSION['user_id'] = $usuarioDAO->getPorEmail($email)->getId();
            $_SESSION['msg'] = $msg;
    
            header('location: ../view/ListarProduto.php');
            exit();
        } catch (Exception $e) {
            session_start();
            $_SESSION['msg'] = $e->getMessage();
            $_SESSION['error'] = true;
            header('location: ../view/CadastrarUsuario.php');
            exit();
        }
    }
    
    

    public function getTodos() {
        unset($_SESSION['msg']);
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->getTodos();
    }

    public function iniciarEditar() {
        $id = filter_input(INPUT_GET, "id");
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getPorId($id);
        session_start();
        $_SESSION['usuario'] = $usuario;
        header('location: ../view/EditarUsuario.php');
        exit();
    }

    public function atualizar() {
        $id = filter_input(INPUT_POST, "id");
        $nome = filter_input(INPUT_POST, "nome");
        $email = filter_input(INPUT_POST, "email");
        $senha = filter_input(INPUT_POST, "senha");

        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);

        $usuarioDAO = new UsuarioDAO();
        $msg = $usuarioDAO->atualizar($usuario);
        session_start();
        $_SESSION['msg'] = $msg;
        header('location: ../view/ListarUsuario.php');
        exit();
    }

    public function excluir() {
        session_start();
        $id = filter_input(INPUT_GET, "id");
        $usuarioDAO = new UsuarioDAO();

        $usuario = new Usuario();
        $usuario->setId($id);
        $msg = $usuarioDAO->excluir($usuario);
        $_SESSION['msg'] = $msg;

        session_unset();
        session_destroy();

        header('Location: ../index.php');
        exit();
    }
}
?>
