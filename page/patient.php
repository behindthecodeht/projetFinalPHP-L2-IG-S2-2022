<?php $titre = "Liste des Dossiers Patient"; ?>

<?php ob_start(); ?>

<section>
    <header class="header-section">
        <h1><?= $titre ?></h1>
        <a href="?page=patient&add" class="btn btn-solid">Nouveau Dossier Pateint</a>
    </header>

    <div class="block">
        <?php if (count($data) > 0) : ?>
            <table class="table-data">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Sexe</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($data as $pat) : ?>
                        <tr>
                            <td><?= $pat->code ?></td>
                            <td><?= $pat->nom ?></td>
                            <td><?= $pat->prenom ?></td>
                            <td><?= ($pat->sexe == 'm') ? "Masculin" : "Féminin" ?></td>
                            <td>
                                <a href="?page=patient&id=<?= $pat->id ?>&show" class="btn btn-outlined">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php else : ?>
            <div class="alert alert-danger">
                <p>Auncun Patient Enregistré !!!</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'layout/default.php'; ?>