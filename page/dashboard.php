<?php

$titre = "Dashbord";


?>

<?php ob_start(); ?>

<section>
    <header class="header-section">
        <h1><?= $titre ?></h1>
    </header>

    <div class="block">
        <div class="grille">
            <div class="grille-item">
                <h3>Dossiers</h3>
                <div class="gr-body">
                    <i class="fa-solid fa-folder-plus"></i>
                    <span class="quantity"><?= $data['nb_patient'] ?></span>
                </div>
                <div class="gr-foot up">
                    <i class="fa-solid fa-circle-arrow-up"></i>
                    <span><strong>10.54%</strong></span>
                </div>
            </div>

            <div class="grille-item">
                <h3>Consultations</h3>
                <div class="gr-body">
                    <i class="fa-solid fa-notes-medical"></i>
                    <span class="quantity"><?= $data['nb_consultation'] ?></span>
                </div>
                <div class="gr-foot down">
                    <i class="fa-solid fa-circle-arrow-down"></i>
                    <span><strong>25.8%</strong></span>
                </div>
            </div>

            <div class="grille-item">
                <h3>Medecin</h3>
                <div class="gr-body">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span class="quantity"><?= $data['nb_medecin'] ?></span>
                </div>
                <div class="gr-foot up">
                    <i class="fa-solid fa-circle-arrow-up"></i>
                    <span><strong>50.45%</strong></span>
                </div>
            </div>

            <div class="grille-item">
                <h3>Prescriptions</h3>
                <div class="gr-body">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span class="quantity"><?= $data['nb_prescription'] ?></span>
                </div>
                <div class="gr-foot down">
                    <i class="fa-solid fa-circle-arrow-down"></i>
                    <span><strong>39.04%</strong></span>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="grille stat">
            <div class="grille-item">
                <h3>Dossiers Créés</h3>
                <div class="gr-body">
                    <div id="chart"></div>
                </div>
            </div>

            <div class="grille-item">
                <h3>Consultations Effectuées</h3>
                <div id="cons-chart"></div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="grille last-update">
        <div class="grille-item">
                <h3>Dernieres Consultations</h3>

                <?php if (count($data['dernier_consultation']) > 0) : ?>
                    <?php foreach ($data['dernier_consultation'] as $cons) : ?>
                        <div class="card">
                            <div class="cr-content">
                                <h4><?= $cons->date_consultation ?></h4>
                                <p><?= $cons->diagnostique ?></p>
                            </div>
                            <a href="?page=consultation&id=<?= $cons->id ?>&show"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="alert alert-danger">
                        <p>Auncun Patient Enregistré !!!</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="grille-item">
                <h3>Nouveaux Dossiers</h3>

                <?php if (count($data['dernier_patient']) > 0) : ?>
                    <?php foreach ($data['dernier_patient'] as $pat) : ?>
                        <div class="card">
                            <div class="cr-content">
                                <h4><?= $pat->prenom . " " . $pat->nom ?></h4>
                                <p><?= $pat->code ?></p>
                            </div>
                            <a href="?page=patient&id=<?= $pat->id ?>&show"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="alert alert-danger">
                        <p>Auncun Patient Enregistré !!!</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="grille-item">
                <h3>Nouveaux Medcins</h3>

                <?php if (count($data['dernier_medecin']) > 0) : ?>
                    <?php foreach ($data['dernier_medecin'] as $pat) : ?>
                        <div class="card med">
                            <i class="fa-solid fa-user-doctor"></i>
                            <div class="cr-content">
                                <h4><?= $pat->prenom . " " . $pat->nom ?></h4>
                                <p><?= $pat->specialite ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="alert alert-danger">
                        <p>Auncun Medecin Enregistré !!!</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    let chartsOptions = {
        series: [302, 475, 523],
        chart: {
            type: 'polarArea'
        },
        labels: ['Consultations', 'Dossiers', 'Prescriptions'],
        fill: {
            opacity: 1
        },
        stroke: {
            width: 1,
            colors: undefined
        },
        yaxis: {
            show: false
        },
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            polarArea: {
                rings: {
                    strokeWidth: 0
                },
                spokes: {
                    strokeWidth: 0
                },
            }
        },
    };

    let chart = new ApexCharts(document.querySelector("#chart"), chartsOptions);
    chart.render();

    let consChartsOptions = {
        chart: {
            type: 'area'
        },
        series: [{
            name: 'Quantité',
            data: [30, 40, 45, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
        }
    }

    let consChart = new ApexCharts(document.querySelector("#cons-chart"), consChartsOptions);
    consChart.render();
</script>

<?php $content = ob_get_clean(); ?>

<?php require 'layout/default.php'; ?>