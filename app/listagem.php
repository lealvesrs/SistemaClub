<?php
require 'header.php'
?>
<?php
require 'menu.php'
?>

<body id="bodyShowMembers">
    <main>
        <?php
        require "conexao.php";


        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        if ($id != "") {
            $sql = "delete from membros where id = ?";

            try {
                $stmt = $conn->prepare($sql);
                $result = $stmt->execute([$id]);
            } catch (Exception $e) {
                $result = false;
                $error = $e->getMessage();
            }

            if ($result == true) {
        ?>
                <div class="alert alert-success" role="alert">
                    <h4>Registro apagado com sucesso!</h4>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Falha ao efetuar exclusão.</h4>
                    <p><?php echo $error; ?></p>
                </div>
            <?php
            }
        }


        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $nome = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);



        if ($nome != "") {

            $sql = "update membros SET nome = ?, email = ?, telefone = ?, cpf = ? where id = ?";

            try {
                $stmt = $conn->prepare($sql);
                $result = $stmt->execute([$nome, $email, $telefone, $cpf, $id]);
            } catch (Exception $e) {
                $result = false;
                $error = $e->getMessage();
            }

            if ($result == true) {
            ?>
                <div class="alert alert-success" role="alert">
                    <h4>Dados alterados com sucesso!</h4>
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
        }

        $sql = "select id, nome, email, telefone, cpf 
            FROM membros order by id";
        $stmt = $conn->query($sql);

        $count = $stmt->rowCount();

        if ($count == 0) {
            ?>
            <div class="mt-5 col-md-10 offset-md-1 text-white text-center">
                <h3 class="fw-lighter">Nenhum membro associado ao clube</h3>

                <h3 class="fw-bold">
                    <a href="index.php" class="text-white ">
                        <ion-icon name="person-add" class="pr-5"></ion-icon>
                        <span>Cadastrar membro</span>

                    </a>
                </h3>
            </div>
        <?php
        } else {
        ?>
            <div class="mt-5 col-md-10 offset-md-1 dashboard-title-container text-center">
                <h1>Associados</h1>
            </div>
            <div class="col-md-10 offset-md-1 dashboard-members-container">

                <table class="table align-middle">
                    <thead class="thead">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><ion-icon name="person-circle-outline"></ion-icon> Nome</th>
                            <th scope="col"><ion-icon name="mail-outline"></ion-icon> Email</th>
                            <th scope="col"><ion-icon name="call-outline"></ion-icon> Telefone</th>
                            <th scope="col"><ion-icon name="calendar-outline"></ion-icon> CPF</th>
                            <th scope="col"><ion-icon name="apps-outline"></ion-icon> Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php
                        while ($row = $stmt->fetch()) {
                        ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nome'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['telefone'] ?></td>
                                <td><?= $row['cpf'] ?></td>
                                <td>
                                    <div id="acoes">
                                        <a class="btn btn-sm btn-warning" href="alterar.php?id=<?= $row['id']; ?>">
                                            <ion-icon name="create-outline"></ion-icon>
                                            Editar
                                        </a>

                                        <a class="btn btn-sm btn-danger" href="listagem.php?id=<?= $row['id']; ?>" onclick="if(confirm('Tem certeza que deseja excluir?')) return true;">
                                            <ion-icon name="trash-outline"></ion-icon>
                                            Excluir
                                        </a>

                                    </div>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        }


        ?>

    </main>

</body>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>