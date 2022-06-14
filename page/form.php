<?php

$page = $_GET['page'];
$table = isset($_GET['prescription']) ? "prescription" : $page;
$titre = "Ajouter " . $table;

if (isset($_POST['submit'])) {
    if ($page == 'consultation') {
        if (isset($_GET['prescription'])) {
            $data = [
                "id_consultation" => $_GET['id'],
                "prescription" => ucfirst($_POST['prescription']),
            ];
        } else {
            $data = [
                "id_medecin" => $_POST['medecin'],
                "id_dossier" => $_POST['patient'],
                "poids" => $_POST['poids'],
                "hauteur" => $_POST['hauteur'],
                "diagnostique" => ucfirst($_POST['diagnostique']),
            ];
        }
    } else {
        $data = [
            "nom" => strtoupper($_POST['nom']),
            "prenom" => ucwords(strtolower($_POST['prenom'])),
            "sexe" => $_POST['sexe'],
            "tel" => $_POST['tel'],
            "adresse" => ucwords(strtolower($_POST['adresse'])),
        ];

        if ($page == 'patient')
            $data["code"] = strtoupper(
                substr($_POST['nom'], 0, 3) . substr($_POST['prenom'], 0, 2) .
                    $_POST['sexe'] . "-" . substr($_POST['tel'], 0, 3)
            );
        else {
            $data['email'] = strtolower($_POST['email']);
            $data['specialite'] = ucwords(strtolower($_POST['specialite']));
        }
    }

    var_dump($data, $table, $page);

    if (isset($_GET['update'])) {
        $data['id'] = $_GET['id'];
        update($table, $data);
    } else {
        print_r(save($table, $data));
    }

    unset($_POST);
    if (isset($_GET['prescription'])) header("Location: ?page=$page&id={$_GET['id']}&show");
    else header("Location: ?page=$page");
    exit;
}

ob_start();

?>


<section>
    <header class="header-section">
        <h1><?= $titre ?></h1>
    </header>

    <div class="block">
        <form action="" method="post" class="form">

            <?php if ($page == "consultation") : ?>
                <?php if (isset($_GET['prescription'])) : ?>
                    <div class="form-group">
                        <label for="prescription">Ajouter des Prescriptions</label>
                        <textarea name="prescription" id="nom" required></textarea>
                    </div>
                <?php else : ?>
                    <div class="form-group row">
                        <div class="row-el">
                            <label for="medecin">Medecin</label>
                            <select name="medecin" id="medecin" required>
                                <option selected disabled>-- Nom du Medcin --</option>
                                <?php if (count($medList) > 0) : ?>
                                    <?php foreach ($medList as $med) : ?>
                                        <option value="<?= $med->id ?>"><?= $med->nom . ' ' . $med->prenom ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option disabled>Aucun Medecin Enregistré</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="row-el">
                            <label for="patient">Patient</label>
                            <select name="patient" id="patient" required>
                                <option selected disabled>-- Nom du Patient --</option>
                                <?php if (count($patList) > 0) : ?>
                                    <?php foreach ($patList as $pat) : ?>
                                        <option value="<?= $pat->id ?>" <?= isset($_GET['id']) && $pat->id == $_GET['id'] ? 'selected' : '' ?>><?= $pat->nom . ' ' . $pat->prenom ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option disabled>Aucun Patient Enregistré</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="row-el">
                            <label for="poids">Poids</label>
                            <input type="number" name="poids" id="poids" required>
                        </div>

                        <div class="row-el">
                            <label for="hauteur">Hauteur</label>
                            <input type="number" name="hauteur" id="hauteur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="diagnostique">Diagnostique</label>
                        <textarea type="text" name="diagnostique" id="diagnostique" required></textarea>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <div class="form-group row">
                    <div class="row-el">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" required value="<?= isset($_GET['update']) ? $data->nom : '' ?>">
                    </div>
                    <div class="row-el">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom" id="prenom" required value="<?= isset($_GET['update']) ? $data->prenom : '' ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="row-el">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" id="sexe" required>
                            <option value="m" <?= isset($_GET['update']) && $data->sexe == 'm' ? 'selected' : '' ?>>Masculin</option>
                            <option value="f" <?= isset($_GET['update']) && $data->sexe == 'f' ? 'selected' : '' ?>>Feminin</option>
                        </select>
                    </div>

                    <div class="row-el">
                        <label for="tel">Telephone</label>
                        <input type="tel" name="tel" id="tel" required value="<?= isset($_GET['update']) ? $data->tel : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" required value="<?= isset($_GET['update']) ? $data->adresse : '' ?>">
                </div>


                <?php if ($page == "medecin") : ?>
                    <div class="form-group row">
                        <div class="row-el">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required value="<?= isset($_GET['update']) ? $data->email : '' ?>">
                        </div>

                        <div class="row-el">
                            <label for="specialite">Specialite</label>
                            <select name="specialite" id="specialite" required>
                                <option selected disabled>-- Specialite --</option>
                                <option <?= isset($_GET['update']) && $data->specialite == "Pediatre" ?  'selected' : ''?> value="Pediatre">Pediatre</option>
                                <option <?= isset($_GET['update']) && $data->specialite == "Gynecologue" ?  'selected' : ''?> value="Gynecologue">Gynecologue</option>
                                <option <?= isset($_GET['update']) && $data->specialite == "Generaliste" ?  'selected' : ''?> value="Generaliste">Generaliste</option>
                                <option <?= isset($_GET['update']) && $data->specialite == "Psycologue" ?  'selected' : ''?> value="Psycologue">Psycologue</option>
                                <option <?= isset($_GET['update']) && $data->specialite == "Dermatologue" ?  'selected' : ''?> value="Dermatologue">Dermatologue</option>
                                <option <?= isset($_GET['update']) && $data->specialite == "Odontologue" ?  'selected' : ''?> value="Odontologue">Odontologue</option>
                                <option <?= isset($_GET['update']) && $data->specialite == "Neurologue" ?  'selected' : ''?> value="Neurologue">Neurologue</option>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <button class="btn btn-solid" type="submit" name="submit">Enregistrer</button>

        </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'layout/default.php'; ?>