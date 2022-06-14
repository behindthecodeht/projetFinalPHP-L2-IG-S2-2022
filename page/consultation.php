<?php

$page = &$_GET['page'];
$titre = "Page " . $page;

?>

<?php ob_start(); ?>

<section>
    <?php if (!isset($_GET['show'])) : ?>
        <header class="header-section">
            <h1><?= $titre ?></h1>
            <a href="?page=<?= $page ?>&add" class="btn btn-solid">Nouvelle Consultation</a>
        </header>

        <div class="block">
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
    <?php else : ?>
        <!-- <header class="header-section">
            <div></div>
            <div>
                <a href="?page=<?php // $page ?>&id=<?php // $cons->id ?>&delete" class="btn btn-danger">Supprimer</a>
            </div>
        </header> -->

        <div class="block">
            <div class="grille">
                <div class="grille-item">
                    <h3>Details Consultation</h3>
                    <table>
                        <tr>
                            <td><strong>DATE CONSULTATION</strong></td>
                            <td><?= $cons->date_consultation ?></td>
                        </tr>
                        <tr>
                            <td><strong>POIDS DU PATIENT</strong></td>
                            <td><?= $cons->poids ?></td>
                        </tr>
                        <tr>
                            <td><strong>HAUTEUR DU PATIENT</strong></td>
                            <td><?= $cons->hauteur ?></td>
                        </tr>
                        <tr>
                            <td><strong>DIAGNOSTIQUE</strong></td>
                            <td><?= $cons->diagnostique ?></td>
                        </tr>
                        <tr>
                            <td><strong>NOM DU MEDECIN</strong></td>
                            <td><?= $medName ?></td>
                        </tr>
                        <tr>
                            <td><strong>NOM DU PATIENT</strong></td>
                            <td><?= $patName ?></td>
                        </tr>
                    </table>
                </div>
                <div class="grille-item">
                    <h3>Prescriptions</h3>

                    <?php if (!empty($pres)) : ?>
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th>Detail de la Prescription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= nl2br($pres->prescription) ?></td>
                                </tr>
                            </tbody>

                        </table>
                    <?php else : ?>
                        <div class="alert alert-danger">
                            <p>Aucune Prescription Enregistré</p>
                        </div><br>
                        <a href="?page=<?= $page ?>&id=<?= $cons->id ?>&add&prescription" class="btn btn-outlined">Ajouter Une Nouvelle</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    <?php endif; ?>

</section>

<?php $content = ob_get_clean(); ?>

<?php require 'layout/default.php'; ?>