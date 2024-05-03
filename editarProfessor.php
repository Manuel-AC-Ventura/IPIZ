<?php
  session_start();
  include_once('./script/conexao.php');

  if(!isset($_SESSION['IPIZ']) && empty($_SESSION['IPIZ'])){
    header("Location: /");
    exit;
  }
  if (!isset($_GET["id"]) || empty($_GET["id"])) {
      header("Location: /");
      exit;
  } else {
      $sql = $conn->prepare("SELECT * FROM funcionarios WHERE id = :id");
      $sql->bindValue(":id", $_GET["id"]);
      $sql->execute();

      $professor = $sql->fetch();
      $id = $_GET["id"];
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $fields = array(
        'nome', 'sobrenome', 'morada', 'contacto', 'email', 'cargo'
      );

      $update_fields = array();
      $params = array(':id' => $id);

      foreach ($fields as $field) {
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
          $update_fields[] = "$field = :$field";
          $params[":$field"] = $_POST[$field];
        }
      }

      if (!empty($update_fields)) {
        $sql = $conn->prepare("UPDATE funcionarios SET " . implode(", ", $update_fields) . " WHERE id = :id");
        $sql->execute($params); 

        header("Location: /professores.php");
        exit;
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
    <title>Editar Professor - SOFT IPIZ</title>
</head>
<body>
<?php include_once('./header.php')?>
<main>
    <img src="/assets/img/teacher.svg" alt="">
    <form id="formulario" method="post">
        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?=$professor["nome"]?>" placeholder="Sobrenome">
        </div>
        <div>
            <label for="sobrenome">Sobrenome</label>
            <input type="text" name="sobrenome" id="sobrenome" value="<?=$professor["sobrenome"]?>" placeholder="Sobrenome">
        </div>

        <div>
            <label for="morada">Morada</label>
            <input type="text" name="morada" id="morada" value="<?=$professor["morada"]?>" placeholder="Morada">
        </div>
        <div>
            <label for="Contacto">Contacto</label>
            <input type="tel" name="contacto" id="contacto" value="<?=$professor["contacto"]?>" placeholder="Contacto">
        </div>

        <div>
            <label for="email">Correio Eletrônico</label>
            <input type="email" name="email" id="email" value="<?=$professor["email"]?>" placeholder="Email">
        </div>

        <div>
            <label for="cargo">Cargo</label>
            <select name="cargo" id="cargo">
                <?php if($professor['cargo'] === 'Diretor'): ?>
                    <option value="Diretor" <?php echo ($professor['cargo'] === 'Diretor') ? 'selected' : ''; ?>>Diretor</option>
                    <option value="Secretaria" <?php echo ($professor['cargo'] === 'Secretaria') ? 'selected' : ''; ?>>Secretaria</option>
                <?php else: ?>
                    <option value="Professor" <?php echo ($professor['cargo'] === 'Professor') ? 'selected' : ''; ?>>Professor</option>
                <?php endif; ?>
            </select>
        </div>

        <div></div>
        <div>
            <button type="submit">Atualizar</button>
        </div>
    </form>
</main>
</body>
</html>
