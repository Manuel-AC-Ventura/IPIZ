<link rel="stylesheet" href="/assets/css/header.css">
<header>
  <a href="/"><img src="/assets/img/logo.png" alt="logo" class="logo"></a>
  <nav>
    <ul>
      <li><a href="/">Inicio</a></li>
      <li><a href="/cursos.php">Cursos</a></li>
      <?php if(isset($_SESSION['IPIZ']) && !empty($_SESSION['IPIZ'])):?>
        <li><a href="/professores.php">Professores</a></li>
        <li><a href="/alunos.php">Alunos</a></li>
        <li><a href="/perfil.php">Perfil</a></li>
        <li><a href="/logout.php">Logout</a></li>
      <?php else:?>
        <li><a href="/login.php">Login</a></li>
      <?php endif;?>
    </ul>
  </nav>
</header>  