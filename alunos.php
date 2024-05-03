<?php
  session_start();
  include_once('./script/conexao.php');
  
  if(!isset($_SESSION['IPIZ']) || empty($_SESSION['IPIZ'])){
    header("Location: /");
    exit;
  }
  
  // Verifica o cargo do usuário logado
  $cargo = '';
  if (isset($_SESSION['IPIZ'])) {
    $sql = $conn->prepare("SELECT cargo FROM funcionarios WHERE id = :id");
    $sql->bindParam(':id', $_SESSION['IPIZ'], PDO::PARAM_INT);
    $sql->execute();
    $cargo_row = $sql->fetch();
    if ($cargo_row) {
      $cargo = $cargo_row['cargo'];
    }
  }

  // Configuração da paginação
  $results_per_page = 10;
  $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($page - 1) * $results_per_page;

  $sql = $conn->prepare('
    SELECT 
      alunos.id,
      alunos.nome, 
      alunos.sobrenome, 
      matriculas.curso, 
      matriculas.turno 
    FROM alunos 
    INNER JOIN matriculas 
      ON alunos.id = matriculas.idAluno
    LIMIT :offset, :results_per_page
  ');
  $sql->bindParam(':offset', $offset, PDO::PARAM_INT);
  $sql->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
  $sql->execute();
  $alunos = $sql->fetchAll(PDO::FETCH_ASSOC);

  $total_sql = $conn->prepare('SELECT COUNT(*) AS total FROM alunos');
  $total_sql->execute();
  $total_alunos = $total_sql->fetch()['total'];
  $total_pages = ceil($total_alunos / $results_per_page);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/assets/css/professores.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alunos - SOFT IPIZ</title>
</head>
<body>
  <?php include_once('./header.php')?>
  <main>
    <?php if ($cargo === 'Diretor' || $cargo === 'Secretaria'): ?>
      <a class="add" href="/addAluno.php" >Cadastrar Aluno</a>
    <?php endif; ?>

    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Sobrenome</th>
          <th>Curso</th>
          <th>Turno</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($alunos as $aluno): ?>
          <tr>
            <td width="200px"><?php echo $aluno['nome']; ?></td>
            <td><?php echo $aluno['sobrenome']; ?></td>
            <td><?php echo $aluno['curso']; ?></td>
            <td><?php echo $aluno['turno']; ?></td>
            <td>
              <?php if ($cargo === 'Diretor' || $cargo === 'Secretaria'): ?>
                <a href="/editarAluno.php?id=<?php echo $aluno['id']; ?>">Editar</a>
                <?php if ($cargo === 'Secretaria'): ?>
                  <a href="/apagarAluno.php?id=<?php echo $aluno['id']; ?>">Apagar</a>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Paginação -->
    <div class="pagination">
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" <?php if ($page === $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
      <?php endfor; ?>
    </div>
  </main>
</body>
</html>
