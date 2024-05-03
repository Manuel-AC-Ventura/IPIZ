<?php
  session_start();
  include_once('./script/conexao.php');
  
  if(!isset($_SESSION['IPIZ']) && empty($_SESSION['IPIZ'])){
    header("Location: /");
    exit;
  }
  $cargo = '';
  if (isset($_SESSION['IPIZ'])) {
    $stmt = $conn->prepare("SELECT cargo FROM funcionarios WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['IPIZ'], PDO::PARAM_INT);
    $stmt->execute();
    $cargo_row = $stmt->fetch();
    if ($cargo_row) {
      $cargo = $cargo_row['cargo'];
    }
  }

  // Defina o número de resultados por página
  $results_per_page = 10;

  // Descubra o número de páginas
  $stmt = $conn->prepare("SELECT COUNT(id) AS count FROM funcionarios WHERE cargo = 'professor'");
  $stmt->execute();
  $row = $stmt->fetch();
  $total_pages = ceil($row['count'] / $results_per_page);

  // Descubra a página atual
  $page = isset($_GET['page']) ? $_GET['page'] : 1;

  // Calcule o offset para a consulta
  $offset = ($page - 1) * $results_per_page;

  // Busque os professores para a página atual
  $stmt = $conn->prepare("SELECT * FROM funcionarios WHERE cargo = 'professor' LIMIT :offset, :results_per_page");
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
  $stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/assets/css/professores.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professores - SOFT IPIZ</title>
</head>
<body>
  <?php include_once('./header.php')?>
  <main>
    <?php if ($cargo === 'Diretor' || $cargo === 'Secretaria'): ?>
      <a class="add" href="/addFuncionario.php" >Cadastrar Professor</a>
    <?php endif; ?>

    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Sobrenome</th>
          <th>Email</th>
          <th>Cargo</th>
          <th>Açção</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $stmt->fetch()): ?>
          <tr>
            <td width="200px"><?php echo $row['nome']; ?></td>
            <td><?php echo $row['sobrenome']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['cargo']; ?></td>
            <td>
              <?php if ($cargo === 'Diretor' || $cargo === 'Secretaria'): ?>
                <a class="edit" href="/editarProfessor.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a class="delete" href="/apagarProfessor.php?id=<?php echo $row['id']; ?>">Apagar</a>
              <?php elseif( $_SESSION['IPIZ'] == $row['id']): ?>
                <a class="edit" href="/editarProfessor.php?id=<?php echo $row['id']; ?>">Editar</a>
              <?php else: ?>
                <span class="disabled">Editar</span>
                <span class="disabled">Apagar</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>
</body>
</html>