<?php
require 'header.php'
?>
<?php
require 'menu.php'
?>
 <?php
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);

        if($name!="" && $email!="" && $phone!="" && $cpf!=""){

        

        require "conexao.php";

        $sql = "insert into membros (nome, email, telefone, cpf) values (?, ?, ?, ?)"; 

        try {
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$name, $email, $phone, $cpf]);
        } catch (Exception $e) {
            $result = false;
            $error = $e->getMessage();
        }

        if ($result == true) { //estava como !==true
        ?>
            <div class="alert alert-success" role="alert">
                <h4>Dados gravados com sucesso!</h4>
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                <h4>Falha ao efetuar gravação.</h4>
                <p><?php echo $error; ?></p>
            </div>            
        <?php
        }}
        ?>

<body id="bodyCadMembro">


     <main>
      <div class="mainPage" id="cadMembro">
        <div id="membro">
          <ion-icon name="person-add-outline"></ion-icon>
          <h1>Adicione um novo associado ao clube</h1>
        </div>
        <div id="formMembro">

          <form action="cadastrar.php" method="POST" enctype="multipart/form-data">
         
            <div class="form-group mb-1">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo" required>
            </div>


            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="email@email.com" required>
            </div>

            <div class="row g-2">
              <div class="col-md">
                <div class="form-group">
                  <label for="phone">Telefone:</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="(99) 99999-9999" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="cpf">CPF:</label>
                  <input type="text" class="form-control" id="cppf" name="cpf" placeholder="999.999.999-99" required>
                </div>
              </div>
              
            </div>

            <div class="d-grid gap-2">
              <input type="submit" class="btn btn-primary" id="btnCad" value="Cadastrar membro">
            </div>

          </form>
    

  </main>

</body>

</html>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

