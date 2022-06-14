<?php

$page = &$_GET['page'];
$titre = $person->nom . ' ' . $person->prenom . ' | Page ' . ucfirst($page);

ob_start();

?>

<section>
    <header class="header-section">
        <div></div>
        <div>
            <a href="?page=consultation&id=<?= $person->id ?>&add" class="btn btn-outlined">Nouvelle Consultation</a>
            <a href="?page=<?= $page ?>&id=<?= $person->id ?>&update" class="btn btn-outlined">Mettre à Jour</a>
            <!-- <a href="?page=<?php // $page ?>&id=<?php // $person->id ?>&delete" class="btn btn-danger">Supprimer</a> -->
        </div>
    </header>

    <div class="block">
        <div class="grille">
            <div class="grille-item">
                <img src="assets/img/avatar.jpg" width="100%" alt="">
            </div>

            <div class="grille-item x-4">
                <table>
                    <tr>
                        <td><strong>NOM & PRENOM</strong></td>
                        <td><?= $person->nom . ' ' . $person->prenom ?></td>
                    </tr>
                    <tr>
                        <td><strong>SEXE</strong></td>
                        <td><?= ($person->sexe == 'm' || $person->sexe == 'M') ? "Masculin" : "Féminin" ?></td>
                    </tr>
                    <tr>
                        <td><strong>TELEPHONE</strong></td>
                        <td><?= $person->tel ?></td>
                    </tr>
                    <tr>
                        <td><strong>ADRESSE</strong></td>
                        <td><?= $person->adresse ?></td>
                    </tr>

                    <?php if ($_GET['page'] == 'medecin') : ?>
                        <tr>
                            <td><strong>EMAIL</strong></td>
                            <td><?= $person->email ?></td>
                        </tr>
                        <tr>
                            <td><strong>SPECIALITE</strong></td>
                            <td><?= $person->specialite ?></td>
                        </tr>
                    <?php endif; ?> 
                </table>
            </div>
        </div> <br><br>
        <div class="grille">
            <div class="grille-item">
                <h3>Consultations Effectuées</h3>

                <?php if (count($data) > 0) : ?>
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Resumé Diagnostique</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($data as $cons) : ?>
                                <tr>
                                    <td><?= $cons->date_consultation ?></td>
                                    <td><?= $cons->diagnostique ?></td>
                                    <td>
                                        <a href="?page=consultation&id=<?= $cons->id ?>&show" class="btn btn-outlined">Details</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                <?php else : ?>
                    <div class="alert alert-danger">
                        <p>Auncune Consultation Enregistrée !!!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'layout/default.php'; ?>