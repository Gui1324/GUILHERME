<?php

class Pessoa{
    public $id_pessoa;
    public $nome;
    public $idade;
    public $data_registro;

    public function __construct($id_pessoa=false) 
    // construtor passando id como parametro, valor padrao para id é falso
    {
        if($id_pessoa){ // caso seja passado um id no construtor
            $this->id_pessoa = $id_pessoa; // associa o id recebido no parametro ao id da classe
            $this->carregar(); // e carrega o restante das propriedades
        }
    }

    public function carregar(){ // carrega 1 registro
        $query = "SELECT nome, idade, data_registro FROM pessoas WHERE id_pessoa = :id_pessoa";
        // seleciona pelo id
        $conexao = Conexao::conectar();
        // cria a conexao
        $stmt = $conexao->prepare($query);
        // prepara a query
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        // vincula o valor do id
        $stmt->execute();
        // executa

        $lista = $stmt->fetch();
        // pega o retorno e coloca em uma lista fazendo o fetch (array chave e valor)
        // abaixo vincula cada valor recebido na lista com as propriedades da classe
        $this->nome = $lista['nome'];
        $this->idade = $lista['idade'];
        $this->data_registro = $lista['data_registro'];
    }

    public function inserir(){ // insere 1 registro
        $query = "INSERT INTO pessoas (nome, idade) VALUES (:nome, :idade)";
        // insere usando query preparada
        $conexao = Conexao::conectar();
        // cria conexao
        $stmt = $conexao->prepare($query);
        // prepara a query
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':idade', $this->idade);
        // os de cima vinculam os valores da query com as propriedades da classe
        $stmt->execute();
        // executa
    }

    public static function listar(){ // lista os registros da tabela
        $query = "SELECT * FROM pessoas";
        // selecione todas as colunas da tabela
        $conexao = Conexao::conectar();
        // cria conexao
        $resultado = $conexao->query($query);
        // executa a query e guarda o que foi retornado em uma variavel resultado
        $lista = $resultado->fetchAll();
        // transforma todos os valores obtidos na variavel resultado em um array associativo ("chave":"valor")
        return $lista;
        // devolve o array
    }

    public function atualizar(){ // atualiza 1 registro
        $query = "UPDATE pessoas SET nome = :nome, idade = :idade WHERE id_pessoa = :id_pessoa";
        // atualiza o registro atraves do id e de forma preparada
        $conexao = Conexao::conectar();
        // cria conexao
        $stmt = $conexao->prepare($query);
        // prepara a query
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":idade", $this->idade);
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        // acima vincula cada propriedade com os valores da query
        $stmt->execute();
        // executa
    }

    public function deletar(){ // exclui 1 registro
        $query = "DELETE FROM pessoas WHERE id_pessoa=:id_pessoa";
        // deleta pelo id e de forma preparada
        $conexao = Conexao::conectar();
        // cria a conexao
        $stmt = $conexao->prepare($query);
        // prepara a query
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        // vincula o id da propriedade da classe, com o id da query
        $stmt->execute();
        // executa
    
    }

    public static function listarPorNome($palavra){ // lista os registros da tabela
       $palavra = '%' . $palavra . '%'; // %palavra%
        $query = "SELECT * FROM pessoas WHERE nome LIKE :palavra";
        // selecione todas as colunas da tabela
        $conexao = Conexao::conectar();
        // cria conexao
        $stmt = $conexao->prepare($query);
        // executa a query e guarda o que foi retornado em uma variavel resultado
        $stmt->bindValue(":palavra", $palavra);
        // vincula o placeholder da palavra com a variavel  palavra do metodo
        $stmt->execute();
        // executa
        $lista = $stmt->fetchAll();
        // transforma todos os valores obtidos na variavel resultado em um array associativo ("chave":"valor")
        return $lista;
        // devolve a lista
    }

}

// C-inserir
// R-carregar e listar
// U-atualizar
// D-deletar
 




?>