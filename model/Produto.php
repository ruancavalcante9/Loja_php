<?php
namespace model;

class Produto {

   private $codigo;
   private $nome;
   private $categoria;
   private $preco;
   private $imagem; // Novo atributo para armazenar a imagem do produto

   public function getCodigo() {
      return $this->codigo;
   }

   public function setCodigo($codigo) {
      $this->codigo = $codigo;
   }

   public function getNome() {
      return $this->nome;
   }

   public function setNome($nome) {
      $this->nome = $nome;
   }

   public function getCategoria() {
      return $this->categoria;
   }

   public function setCategoria($categoria) {
      $this->categoria = $categoria;
   }

   public function getPreco() {
      return $this->preco;
   }

   public function setPreco($preco) {
      $this->preco = $preco;
   }

   
   public function getImagem() {
      return $this->imagem;
   }

   public function setImagem($imagem) {
      $this->imagem = $imagem;
   }

}
?>
