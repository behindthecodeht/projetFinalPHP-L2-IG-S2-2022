<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $titre . " - Hopital" ?></title>

    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="content-page">
        <header class="header">
            <?php if (!isset($_GET['q'])) : ?>
                <form action="" method="get">
                    <input type="hidden" name="page" value="<?= isset($_GET['page']) ? $_GET['page'] : "dashboard" ?>">
                    <?php if (isset($_GET['page']) && $_GET['page'] == 'medecin') : ?>
                        <select name="q" id="q" required>
                            <option selected disabled>-- Selectionner la Specialite --</option>
                            <?php if (count($speList) > 0) : ?>
                                <?php foreach ($speList as $med) : ?>
                                    <option value="<?= $med->specialite ?>"><?= $med->specialite ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option disabled>Aucun Medecin Enregistré</option>
                            <?php endif; ?>
                        </select>
                    <?php else : ?>
                        <input type="text" name="q" id="q" required>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-solid">Rechercher</button>
                </form>
            <?php endif; ?>
        </header>

        <main>
            <?= $content ?>
        </main>

        <footer>

        </footer>
    </div>

    <aside>
        <div class="logo">
            <h2>Ges. Hopital</h2>
        </div>
        <nav>
            <ul>
                <li><a href="?page=dashboard"><i class="fa-solid fa-gauge-high"></i></i><span>Dashbord</span></a></li>
                <li><a href="?page=patient"><i class="fa-solid fa-folder-plus"></i><span>Dossiers Patient</span></a></li>
                <li><a href="?page=consultation"><i class="fa-solid fa-folder-plus"></i><span>Consultations</span></a></li>
                <li><a href="?page=medecin"><i class="fa-solid fa-user-doctor"></i><span>Medecins</span></a></li>
            </ul>
        </nav>
    </aside>
</body>

</html>