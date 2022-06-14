<?php $titre = "Liste des Medecins"; ?>

<?php ob_start(); ?>

<section>
    <header class="header-section">
        <h1><?= $titre ?></h1>
        <a href="?page=medecin&add" class="btn btn-solid">Nouveau Medecin</a>
    </header>

    <div class="block">
        <?php if (count($data) > 0) : ?>
            <table class="table-data">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>sexe</th>
                        <th>Specialite</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($data as $med) : ?>
                        <tr>
                            <td><?= $med->nom ?></td>
                            <td><?= $med->prenom ?></td>
                            <td><?= ($med->sexe == 'm') ? "Masculin" : "Féminin" ?></td>
                            <td><?= $med->specialite ?></td>
                            <td>
                                <a href="?page=medecin&id=<?= $med->id ?>&show" class="btn btn-outlined">Voir</a>
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