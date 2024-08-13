<?php
require 'header.php'
?>
<body>

<?php
require 'menu.php'
?>

<div class="inicio">

    <div class="row">
        <?php
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);

        if($name)

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
        }
        ?>

    </div>
    <a href="index.php" class="btn btn-info ms-5" role="button">Voltar</a>
</div>

<?php
require 'footer.php'
?>
</body>