<?php

class Pessoa {

    private $pdo;

    //construtor
    public function __construct($host,$dbname,$username,$password)
    {
        //CONEXÃO COM O BANCO DE DADOS
       try{
        $this->pdo = new PDO("mysql:host=".$host.";dbname=".$dbname,$username,$password);
       } catch(PDOException $e){
           echo "Erro na conexão com o banco de dados: ".$e->getMessage();
       } catch(Exception $e){
           echo "Erro genérico: ".$e->getMessage();
       }
    }
    
    //BUSCA DOS DADOS
    public function buscaDados(){
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    //CADASTRAR PESSOAS
    public function cadastrarPessoa($nome,$telefone,$email){
        
    //VERIFICAÇÃO DE EMAIL
    $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
    $cmd->bindValue(":e",$email);
    $cmd->execute();

    if($cmd->rowCount() > 0): //verifica pelo id se o e-mail já existe
        return false;
    else: //cadastro da pessoa
        $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome,telefone,email) VALUES (:n,:t,:e)");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":t",$telefone);
        $cmd->bindValue(":e",$email);
        $cmd->execute();
        return true;
    endif;
    }

    //DELETAR PESSOAS
    public function deletarPessoa($id){
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }

    //ATUALIZAR DADOS E BUSCAR
    public function buscarDadosPessoa($id){
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function atualizarPessoa($id,$nome,$telefone,$email){
        $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e WHERE id = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":t",$telefone);
        $cmd->bindValue(":e",$email);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }
    
}