<?php
  session_start(); 

  if(isset($_SESSION['IPIZ'])){
    header("Location: /");
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $erro = '';
    include_once('./script/conexao.php');

    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
      try{
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = $conn->prepare("SELECT * FROM funcionarios WHERE email = :email AND senha = :senha");
        $sql->bindParam(':email', $email);
        $sql->bindParam(':senha', $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
          $info = $sql->fetch();
          $_SESSION['IPIZ'] = $info['id'];
          header("Location: /");
        }else{
          $erro = "Credenciais inválidas!";
        }
      }catch(PDOException $e){
        $erro = "Erro: ".$e->getMessage();
      }
    }else{
      $erro = "Preencha todos os campos!";
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="/assets/css/login.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Funcionário - SOFT IPIZ</title>
</head>
<body>
  <?php include_once('./header.php')?>
  <form method="post">
    <label for="email">E-mail</label>
    <input type="text" id="email" name="email" placeholder="E-mail">
    <label for="senha">Senha</label>
    <input type="text" id="senha" name="senha" placeholder="Senha">
    <p><?php if(!empty($erro))echo $erro;?></p>
    <button>Entrar</button>
  </form>
</body>
</html>