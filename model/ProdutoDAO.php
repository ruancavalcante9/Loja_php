<?php
namespace model;
require "Conexao.php";

use model\Conexao;
use PDOException;

class ProdutoDAO
{
    public function salvar($produto)
    {
        // 1 -  Cria o objeto de Conexão
        $conexao = new Conexao();
        // 2 -  Recuperar uma conexão com o banco
        $conn = $conexao->getConnection();
        // 3 - Montar o SQL
        $INSERT = "INSERT INTO produtos(nome, categoria, preco, imagem) VALUES (:nome, :categoria, :preco, :imagem)";
        // 4- Cria a Consulta (statement)
        $stmt = $conn->prepare($INSERT);
        // 5 - Preencher os dados do Produto
        $nome = $produto->getNome();
        $categoria = $produto->getCategoria();
        $preco = $produto->getPreco();
        $imagem = $produto->getImagem(); 
        // 6 - Associa os parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem', $imagem); 
        // 7 - Realiza a consulta
        $stmt->execute();
        return "Produto Salvo com sucesso";
    }

    public function getTodos()
    {
        // 1 - Instancia
        $conexao = new Conexao();
        // 2 - Recupera
        $connection = $conexao->getConnection();
        // 3 - SQL
        $SQL = 'SELECT * FROM produtos';
        // 4 - Realiza a consulta
        $resultado = $connection->query($SQL);
        $produtos = []; // Inicializa a resposta
        while ($linha = $resultado->fetch()) {
            $produto = new Produto();
            $produto->setCodigo($linha['codigo']);
            $produto->setNome($linha['nome']);
            $produto->setCategoria($linha['categoria']);
            $produto->setPreco($linha['preco']);
            $produto->setImagem($linha['imagem']); 
            array_push($produtos, $produto);
        }
        return $produtos;
    }

    public function getPorCodigo($codigo)
    {
        try {
            $conexao = new Conexao();
            $connection = $conexao->getConnection();
            $SQL = "SELECT * FROM produtos WHERE codigo = :codigo";
            $stmt = $connection->prepare($SQL);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            $resultado = $stmt->fetch();
            return $resultado;
        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }

    public function atualizar($produto)
    {
        try {
            $conexao = new Conexao();
            // 2 - Recupera a conexão
            $connection = $conexao->getConnection();
            // 3 - SQL para atualização
            $UPDATE = "UPDATE produtos SET nome = :nome, categoria = :categoria, preco = :preco, imagem = :imagem WHERE codigo = :codigo";
            $stmt = $connection->prepare($UPDATE);

            $codigo = $produto->getCodigo();
            $nome = $produto->getNome();
            $categoria = $produto->getCategoria();
            $preco = $produto->getPreco();
            $imagem = $produto->getImagem(); 

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':imagem', $imagem); 
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            return "Produto atualizado com sucesso";
        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }

    public function excluir($produto)
    {
        try {
            // 1 - Cria o objeto de Conexão
            $conexao = new Conexao();
            // 2 - Recupera uma conexão com o banco
            $conn = $conexao->getConnection();
            // 3 - Montar o SQL
            $DELETE = "DELETE FROM produtos WHERE codigo = :codigo";
            // 4 - Cria a Consulta (statement)
            $stmt = $conn->prepare($DELETE);
            // 5 - Preencher os dados do Produto
            $codigo = $produto->getCodigo();
            // 6 - Associa os parâmetros
            $stmt->bindParam(':codigo', $codigo);
            // 7 - Realiza a consulta
            $stmt->execute();
            return "Produto excluído com sucesso";
        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }
}
?>
