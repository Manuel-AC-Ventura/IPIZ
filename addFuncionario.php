<?php
  session_start();
  if(!isset($_SESSION['IPIZ']) && empty($_SESSION['IPIZ'])){
    header("Location: /");
    exit;
  }
  
  include_once('./script/conexao.php');
    $sql = $sql = $conn->prepare("SELECT cargo FROM funcionarios WHERE id = :id");
    
    $sql->bindParam(':id', $_SESSION['IPIZ']);
    $sql->execute();
    $functionario = $sql->fetch();

    if($functionario['cargo'] != 'Diretor'){
      header("Location: /");
      exit;
    }else{
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['numBI']) && isset($_POST['naturalidade']) && isset($_POST['morada']) && isset($_POST['contacto']) && isset($_POST['especialidade']) && isset($_POST['email']) && isset($_POST['cargo'])){
          try{
            $sql = $conn->prepare("INSERT INTO funcionarios (nome, sobrenome, numBI, naturalidade, morada, contacto, especialidade, email, cargo) VALUES (:nome, :sobrenome, :numBI, :naturalidade, :morada, :contacto, :especialidade, :email, :cargo)");
          
            $sql->bindParam(':nome', $_POST['nome']);
            $sql->bindParam(':sobrenome', $_POST['sobrenome']);
            $sql->bindParam(':numBI', $_POST['numBI']);
            $sql->bindParam(':naturalidade', $_POST['naturalidade']);
            $sql->bindParam(':morada', $_POST['morada']);
            $sql->bindParam(':contacto', $_POST['contacto']);
            $sql->bindParam(':especialidade', $_POST['especialidade']);
            $sql->bindParam(':email', $_POST['email']);
            $sql->bindParam(':cargo', $_POST['cargo']);
            $sql->execute();
          }catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
          }
        }else{
          echo "Preencha todos os campos";
        }
      }
    }
?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="/assets/css/addFuncionario.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Funcionário - SOFT IPIZ</title>
</head>
<body>
  <?php include_once('./header.php')?>
  <main>
    <img src="/assets/img/teacher.svg" alt="">

    <form method="post">
      <div>
        <label for="nome">Primeiro Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Primeiro Nome">
      </div>
      <div>
        <label for="sobrenome">Sobrenome</label>
        <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
      </div>

      <div>
        <label for="numBI">Número do BI</label>
        <input type="text" id="numBI" name="numBI" placeholder="Número do BI">
      </div>
      <div>
        <label for="naturalidade">Naturalidade</label>
        <input type="text" id="naturalidade" name="naturalidade" placeholder="Naturalidade">
      </div>

      <div>
        <label for="morada">Morada</label>
        <input type="text" id="morada" name="morada" placeholder="Morada">
      </div>
      <div>
        <label for="contacto">Contacto</label>
        <input type="tel" id="contacto" name="contacto" placeholder="Contacto">
      </div>

      <div>
        <label for="especialidade">Especialidade</label>
        <input type="text" id="especialidade" name="especialidade" placeholder="Especialidade">
      </div>
      <div>
        <label for="email">Correio Eletrônico</label>
        <input type="email" id="email" name="email" placeholder="E-mail">
      </div>

      <div>
        <label for="cargo">Cargo</label>
        <select name="cargo" id="cargo">
          <option value="cargo" selected disabled>Cargo</option>
          <option value="Diretor">Diretor</option>
          <option value="Professor">Professor</option>
          <option value="Secretaria">Secretaria</option>
        </select>
      </div>
      <div>
        <label for=""></label>
        <button>Cadastrar</button>
      </div>
    </form>
  </main>
</body>
</html>