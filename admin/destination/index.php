<?php

require_once '../../db.php';
require_once '../is_connected.php';
require_once '../is_messages.php';

$sql = "SELECT * FROM DESTINATION ORDER BY id ASC";
$destinations = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

require_once '../../layouts/admin/header.php';

if (isset($success_messages)) {
    foreach ($success_messages as $success){
        echo '<p class="message alert-success"><span style="display: flex; align-items: center;"><i style="color: green; font-size: 1.5rem; padding-right: 1rem;" class="fa-regular fa-circle-check"></i>'.$success.'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></p>';
    }
    unset($success_messages);
}
if (isset($error_messages)) {
    foreach ($error_messages as $error){
        echo '<p class="message alert-danger"><span style="display: flex; align-items: center;"><i style="color: red; font-size: 1.5rem; padding-right: 1rem;" class="fa-solid fa-xmark"></i>'.$error.'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></p>';
    }
    unset($error_messages);
}

?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des destinations</h1>
        <a href="new.php" class="btn btn-primary">Ajouter une destination</a>
    </div>

    <!-- on liste tous les utilisateurs -->
    <table class="table">
        <thead>
            <tr class="table-header">
                <th>ID</th>
                <th>TITRE</th>
                <th>CRÉÉ LE</th>
                <th>ACTION</th>
            </tr>
        </thead>

        <tbody>
        <?php if (count($destinations) > 0) { ?>
            <!-- on affiche tout les utilisateus-->
            <?php foreach ($destinations as $destination) : ?>
                <tr>
                    <td> <?= $destination['id']; ?></td>
                    <td> <?= $destination['name']; ?></td>
                    <td> <?= $destination['created_at']; ?></td>
                    <td>
                        <a href="edit.php?edit=<?= $destination['id']; ?>" class="btn btn-warning">Modifier</a>
                        <form action= "delete.php?id=<?= $destination['id'] ?>" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette destination ?')" style="display: inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="text-center">Il n'y a pas de destination</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php require_once '../../layouts/admin/footer.php'; ?>