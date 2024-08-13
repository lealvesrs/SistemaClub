<?php
require 'header.php';

require 'menu.php';

require "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
?>
  <div class="alert alert-danger" role="alert">
    <h4>Falha ao abrir formulário para edição.</h4>
    <p>ID está vazio.</p>
  </div>
<?php
  exit;
}

$sql = "select id, nome, email, telefone, cpf 
            FROM membros where id=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

$membro = $stmt->fetch();

?>

<body id="bodyCadMembro">


  <main>
    <div class="mainPage" id="cadMembro">
      <div id="membro">
        <ion-icon name="person-add-outline"></ion-icon>
        <h1>Altere o membro do clube</h1>
      </div>
      <div id="formMembro">

        <form action="listagem.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $id ?>">
          <div class="form-group mb-1">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo" required value="<?= $membro["nome"] ?>">
          </div>


          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="email@email.com" required value="<?= $membro["email"] ?>">
          </div>

          <div class="row g-2">
            <div class="col-md">
              <div class="form-group">
                <label for="phone">Telefone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="(99) 99999-9999" required value="<?= $membro["telefone"] ?>">
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cppf" name="cpf" placeholder="999.999.999-99" required value="<?= $membro["cpf"] ?>">
              </div>
            </div>

          </div>

          <div class="d-grid gap-2">
            <input type="submit" class="btn btn-primary" id="btnCad" value="Alterar membro">
          </div>

        </form>


  </main>

</body>

</html>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>