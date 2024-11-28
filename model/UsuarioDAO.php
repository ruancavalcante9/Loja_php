<?php
namespace model;

require_once "Conexao.php";

use model\Conexao;
use PDO;
use PDOException;
use Exception;

class UsuarioDAO {
    public function salvar($usuario) {
        try {
            $conexao = new Conexao();
            $conn = $conexao->getConnection();
            
            $email = $usuario->getEmail();
            $SQL = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->fetch()) {
                throw new Exception("O email já está em uso.");
            }
    
            $INSERT = "INSERT INTO usuarios(nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $conn->prepare($INSERT);
            $nome = $usuario->getNome();
            $email = $usuario->getEmail();
            $senha = $usuario->getSenha();
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            return "Usuário registrado com sucesso";
        } catch (PDOException $e) {
            throw new Exception("Erro ao salvar o usuário: " . $e->getMessage());
        }
    }
    

    public function getPorEmail($email) {
        $conexao = new Conexao();
        $connection = $conexao->getConnection();
        $SQL = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $connection->prepare($SQL);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            $usuario = new Usuario();
            $usuario->setId($resultado['id']);
            $usuario->setNome($resultado['nome']);
            $usuario->setEmail($resultado['email']);
            $usuario->setSenha($resultado['senha']);
            return $usuario;
        } else {
            throw new Exception("Usuário não encontrado.");
        }
    }

    public function getTodos() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $conexao = new Conexao();
        $connection = $conexao->getConnection();
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $SQL = 'SELECT * FROM usuarios WHERE id = :id';
            $stmt = $connection->prepare($SQL);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $usuarios = [];
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario();
                $usuario->setId($linha['id']);
                $usuario->setNome($linha['nome']);
                $usuario->setEmail($linha['email']);
                $usuario->setSenha($linha['senha']);
                array_push($usuarios, $usuario);
            }
            return $usuarios;
        } else {
            throw new Exception('Usuário não está logado.');
        }
    }

    public function getPorId($id) {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $conexao = new Conexao();
            $connection = $conexao->getConnection();
            $SQL = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $connection->prepare($SQL);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch();
            return $resultado;
        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }

    public function atualizar($produto) {
        try {
            $conexao = new Conexao();
            $connection = $conexao->getConnection();
            $UPDATE = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
            $stmt = $connection->prepare($UPDATE);
            $id = $produto->getId();
            $nome = $produto->getNome();
            $email = $produto->getEmail();
            $senha = $produto->getSenha();
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return "Usuário atualizado com sucesso";
        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }

    public function excluir($produto) {
        try {
            $conexao = new Conexao();
            $conn = $conexao->getConnection();
            $DELETE = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $conn->prepare($DELETE);
            $id = $produto->getId();
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return "Usuário excluído com sucesso";
        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }
}
?>
