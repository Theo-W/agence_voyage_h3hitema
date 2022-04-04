<?php

require_once '../../db.php';
require_once '../is_connected.php';

$sql = "SELECT * FROM TAG ORDER BY id ASC";
$options = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

require_once '../../layouts/admin/header.php'
?>

<div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
    <h1>Gestion des options</h1>
    <a href="new.php" class="btn btn-primary">Créer une option</a>
</div>
<!-- on liste tout les utilisateurs -->
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>Nom</th>
        <th>Date</th>
        <th>action</th>
    </tr>
    </thead>

    <tbody>
    <?php if (count($options) > 0) { ?>
        <!-- on affiche tout les utilisateus-->
        <?php foreach ($options as $option) : ?>
            <tr>
                <td> <?= $option['id']; ?></td>
                <td> <?= $option['nom']; ?></td>
                <td> <?= $option['Date']; ?></td>
                <td>
                    <form action="admin/delete.php?id=<?= $option['id'] ?>" method="post"
                            onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')"
                            style="display: inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php } else { ?>
        <tr>
            <td colspan="6" class="text-center">Il n'y a pas d'option</td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php require_once '../../layouts/admin/footer.php'; ?>