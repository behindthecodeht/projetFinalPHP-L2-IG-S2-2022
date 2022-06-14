<?php

$titre = 'Resultats pour ' . $_GET['q'];

ob_start();

?>

<section>
    <header class="header-section">
        <h1>Resultats pour "<?= $_GET['q'] ?>"</h1>
    </header>

    <div class="block">
        <div class="grille wrap">
            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $el) : ?>
                    <div class="grille-item">
                        <h3><?= $el->nom . ' ' . $el->prenom ?></h3>
                        <div class="gr-foot up">
                            <i class="fa-solid <?= isset($el->specialite) ? 'fa-user-doctor' : 'fa-folder-plus' ?>"></i>
                            <span><strong><?= isset($el->specialite) ? 'Medecin' : 'Patient' ?></strong></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-danger">
                    <p>Auncun Resultat ...</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'layout/default.php'; ?>