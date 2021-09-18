<?php

//Require
require_once "classe_pessoa.php";

//CONEXÃO COM O BANCO DE DADOS
$p = new Pessoa("localhost","crudpdo3","root","");

    //VERIFICA SE O BOTÃO FOI CLICADO
    if(isset($_POST['cadastro'])):

        //VERIFICA SE O BOTÃO ATUALIZAR EXISTE
        if(isset($_GET['id_up']) && !empty($_GET['id_up'])):
            $id = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);

            //VERIFICA SE AS INPUTS FORAM PREENCHIDAS
            if(!empty($nome) && !empty($telefone) && !empty($email)):
                $p->atualizarPessoa($id,$nome,$telefone,$email);
                header("Location: index.php");
            endif;

        else:
            $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);

        //VERIFICA SE AS INPUTS ESTÃO PREENCHIDAS
        if(!empty($nome) &&  !empty($telefone) && !empty($email)):
           if(!$p->cadastrarPessoa($nome,$telefone,$email)):
                echo "Dados já cadastrados";
           endif;
        else:
            ?>
            <div class="aviso">
                <img src="imagens/warning.png"/>
                <h5>Preencha todos os campos!</h5>
            </div>
            
            <?php
        endif;
        endif;

        
        
    endif;

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta chartset="utf-8"/>
        <title>Cadastrar Pessoa</title>
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <?php
         //BUSCAR OS DADOS DA PESSOA E ATUALIZAR
        if(isset($_GET['id_up'])):
        $id = addslashes($_GET['id_up']);
        $res =  $p->buscarDadosPessoa($id);
    
endif;
        ?>
        <section id="esquerda">
            <form action="" method="post">
            <h1><?php if(isset($res)): echo "Atualizar Pessoa"; else: echo "Cadastrar"; endif;?></h1>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>"/>
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="<?php if(isset($res)):echo $res['telefone']; endif; ?>"/>
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" value="<?php if(isset($res)): echo $res['email']; endif;?>"/>
                <input type="submit" name="cadastro" id="botao" value="<?php if(isset($res)): echo "Atualizar"; else: echo "Cadastrar"; endif;?>"/>
            </form>
        </section>
                
        <section id="direita">
        <table>
            <tr id="titulo"> 
                         <td>NOME</td>
                        <td>TELEFONE</td>
                        <td colspan="2">E-MAIL</td>
            </tr>
        <?php
            $dados = $p->buscaDados();
            if(count($dados) > 0){
                for($i = 0; $i < count($dados); $i++){
                    echo "<tr>";
                    foreach($dados[$i] as $k => $v){
                        
                        if($k != 'id'){
                            echo "<td>$v</td>";
                        }
                    }
                    ?>
                    <td><a href="index.php?id_up=<?php echo $dados[$i]['id']; ?>">Editar</a><a href="index.php?id=<?php echo $dados[$i]['id']?>">Excluir</a></td>
                    <?php

                }  
                 echo"</tr>";    
            } else{
                ?>
                    <div class="aviso">
                        
                        <h5>Nenhum dado cadastrado</h5>
                    </div>
                <?php
            }
            
            ?>
                    
                    <?php
        
                    ?>
                </table>
        </section>
    </body>
</html>


<?php

//EXCLUIR PESSOAS
if(isset($_GET['id'])):
    $id_pessoa = addslashes($_GET['id']);
    $cmd = $p->deletarPessoa($id_pessoa);
    header("Location: index.php");
endif;



?>