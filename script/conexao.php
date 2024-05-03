<?php

try {
  $conn = new PDO("mysql:host=localhost;dbname=IPIZ;charset=utf8", "root", "123");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Erro na conexão: " . $e->getMessage();
}
