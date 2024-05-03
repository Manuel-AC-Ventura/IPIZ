<?php 
  session_start();
  include_once('./script/conexao.php');


  if(!isset($_SESSION['IPIZ']) || empty($_SESSION['IPIZ'])){
    header("Location: /");
    exit;
  }
  
  $sql = $conn->prepare("SELECT cargo FROM funcionarios WHERE id = :id");
  $sql->bindParam(':id', $_SESSION['IPIZ'], PDO::PARAM_INT);
  $sql->execute();
  $cargo_row = $sql->fetch();
  if ($cargo_row['cargo'] !== 'Diretor' && $cargo_row['cargo'] !== 'Secretaria') {
    header("Location: /alunos.php");
    exit;
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['numBI']) && isset($_POST['naturalidade']) && isset($_POST['nomePai']) && isset($_POST['nomeMae']) && isset($_POST['morada']) && isset($_POST['contacto']) && isset($_POST['dataNascimento']) && isset($_POST['genero']) && isset($_POST['anoEscolar']) && isset($_POST['curso']) && isset($_POST['turno'])){
        try{
          $sql = $conn->prepare("INSERT INTO alunos (nome, sobrenome, numBI, naturalidade, nomePai, nomeMae, morada, contacto, outroContacto, dataNascimento, genero) VALUES (:nome, :sobrenome, :numBI, :naturalidade, :nomePai, :nomeMae, :morada, :contacto, :outroContacto, :dataNascimento, :genero)");

          $sql->bindParam(':nome', $_POST['nome']);
          $sql->bindParam(':sobrenome', $_POST['sobrenome']);
          $sql->bindParam(':numBI', $_POST['numBI']);
          $sql->bindParam(':naturalidade', $_POST['naturalidade']);
          $sql->bindParam(':nomePai', $_POST['nomePai']);
          $sql->bindParam(':nomeMae', $_POST['nomeMae']);
          $sql->bindParam(':morada', $_POST['morada']);
          $sql->bindParam(':contacto', $_POST['contacto']);
          $sql->bindParam(':outroContacto', $_POST['outroContacto']);
          $sql->bindParam(':dataNascimento', $_POST['dataNascimento']);
          $sql->bindParam(':genero', $_POST['genero']);

          if($sql->execute()){
            $idAluno = $conn->lastInsertId();

            $sql = $conn->prepare("INSERT INTO matriculas (idAluno, anoEscolar, curso, turno) VALUES (:idAluno, :anoEscolar, :curso, :turno)");
            $sql->bindParam(':idAluno', $idAluno);
            $sql->bindParam(':anoEscolar', $_POST['anoEscolar']);
            $sql->bindParam(':curso', $_POST['curso']);
            $sql->bindParam(':turno', $_POST['turno']);

        if($sql->execute()){
            echo "<p class='message'>Aluno cadastrado com sucesso!</p";
        } else {
            echo "<p class='message'>Erro ao cadastrar aluno.</p";
            $erro = 'Erro ao cadastrar aluno.';
        }
      }
     }catch(PDOException $e){
        echo "Erro: " . $e->getMessage();
        $erro = "<p class='message'>Erro ao cadastrar aluno.</p";
     }
    } else {
      $erro = "<p class='message'>Preencha todos os campos!</p";
    }
  }
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="/assets/css/addAluno.css" />
  <script src="/assets/js/validacao.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Aluno - SOFT IPIZ</title>
</head>
<body>
  <?php include_once('./header.php')?>
  
  <?php if(isset($erro)):?>
    <p><?php echo $erro;?></p>
  <?php endif?>
  <main>
    <img src="/assets/img/addaluno.svg" alt="">

    <form id="container" method="post">
      <div class="form form1">
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
          <label for="nomePai">Nome do Pai</label>
          <input type="text" id="nomePai" name="nomePai" placeholder="Nome do Pai" required>
        </div>
        <div>
          <label for="nomeMae">Nome da Mãe</label>
          <input type="text" id="nomeMae" name="nomeMae" placeholder="Nome da Mãe" required>
        </div>

        <div>
          <label for="morada">Morada</label>
          <input type="text" id="morada" name="morada" placeholder="Morada" required>
        </div>
        <div>
          <label for="contacto">Contacto</label>
          <input type="tel" id="contacto" name="contacto" placeholder="Contacto" required>
        </div>

        <div>
          <label for="outroContacto">Outro Contacto</label>
          <input type="tel" id="outroContacto" name="outroContacto" placeholder="Outro Contacto">
        </div>
        <div>
          <label for="dataNascimento">Data de Nascimento</label>
          <input type="date" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento" required>
        </div>

        <div></div>
        <div>
          <button type="button" id="continuarBtn">Continuar</button>
        </div>
      </div>

      <div class="form form2">
        <div>
          <label for="genero">Gênero</label>
          <select id="genero" name="genero" required>
            <option value="" selected disabled>Selecione o Gênero</option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
          </select>
        </div>
        <div>
          <label for="anoEscolar">Ano Escolar</label>
          <input type="number" id="anoEscolar" name="anoEscolar" placeholder="Ano Escolar" required>
        </div>

        <div>
          <label for="curso">Curso</label>
          <select id="curso" name="curso" required>
            <option value="" selected disabled>Selecione o Curso</option>
            <option value="Ciências">Ciências</option>
            <option value="Letras">Letras</option>
            <option value="Humanidades">Humanidades</option>
          </select>
        </div>
        <div>
          <label for="turno">Turno</label>
          <select id="turno" name="turno" required>
            <option value="" selected disabled>Selecione o Turno</option>
            <option value="Manhã">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
          </select>
        </div>

        <div>
          <button id="voltarBtn">Voltar</button>
        </div>
        <div>
          <button id="cadastrarBtn" name="cadastrarBtn">Cadastrar</button>
        </div>
      </div>
    </form>
  </main>
</body>
</html>