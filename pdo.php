<?php

/*


//--------------CONEXÃO COM O BANCO DE DADOS--------------------------------------
try{
    $pdo = new PDO('mysql:host=localhost;dbname=crudpdo3;charset=utf8','root','');
}catch(PDOException $e){
    echo "Erro no banco de dados: ".$e->getMessage();
}catch(Exception $e){
    echo "Erro genérico: ".$e->getMessage();
}


//---------------INSERT------------------------------------------------------------
//1:FORMA
$res = $pdo->prepare("INSERT INTO PESSOA (nome,telefone,email) VALUES(:n,:t,:e)"); //prepare precisa do bindvalues e do execute
$res->bindValue(":n","Maria Aparecida");
$res->bindValue(":t","12 35678911");
$res->bindValue(":e","mariaapa@gmail.com");

//$res->execute();

/*2:FORMA
$pdo->query("INSERT INTO PESSOA (nome,telefone,email) VALUES('Márcio','13 981656744','marciopereira@gmail.com')");
*/

//------------------DELETE E UPDATE-------------------------------------------------------

//$cmd = $pdo->prepare("DELETE  FROM PESSOA WHERE id = :id");
//$id = 3 ;
//$cmd->bindValue(":id","$id");
//$cmd->execute();

//$cmd = $pdo->query("DELETE FROM PESSOA WHERE id = 1");

/*$cmd = $pdo->prepare("UPDATE PESSOA SET email = :e WHERE id = :id");
$id = 2;
$email = "Brunolegal@gmail.com";
$cmd->bindValue(":e","$email");
$cmd->bindValue(":id","$id");
$cmd->execute();*/


//---------------------SELECT-------------------------------------
/*
$cmd = $pdo->prepare("SELECT * FROM PESSOA WHERE id = :id");
$cmd->bindValue(":id","2");
$cmd->execute();

$res = $cmd->fetch(PDO::FETCH_ASSOC);

foreach($res as $key => $value):
    echo $key.": ".$value."</br>";
endforeach;

/*
echo "<pre>";
print_r($res);
echo "</pre>";
*/