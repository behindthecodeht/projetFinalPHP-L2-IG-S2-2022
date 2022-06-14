<?php

require "model.php";

function dashboard(){
    $data = [
        "nb_patient" => fetchCount('patient'),
        "nb_medecin" => fetchCount('medecin'),
        "nb_consultation" => fetchCount('consultation'),
        "nb_prescription" => fetchCount('prescription'),
        "dernier_patient" => fetchLast('patient'),
        "dernier_medecin" => fetchLast('medecin'),
        "dernier_consultation" => fetchLast('consultation')
    ];
    require "page/dashboard.php";
}

function search(){
    $data = searchByKeyord($_GET['page'], $_GET['q']);
    require "page/search.php";
}

function consultation(){
    if(isset($_GET['show'])){
        $cons = fetch("consultation", $_GET['id']);
        $pres = fetch('prescription', $_GET['id']);
        $pat = fetch('patient', $cons->id_dossier);
        $med = fetch('medecin', $cons->id_medecin);
        $patName = $pat->nom . ' ' . $pat->prenom;
        $medName = $med->nom . ' ' . $med->prenom;
    }else
        $data = fetchPage('consultation');
    require "page/consultation.php";
}

function medecin(){
    $data = fetchPage('medecin');
    $speList = request("SELECT DISTINCT specialite FROM medecin");
    require "page/medecin.php";
}

function patient(){
    $data = fetchPage('patient');
    require "page/patient.php";
}

function form(){
    if($_GET['page'] == 'consultation'){
        $medList = fetchAll('medecin');
        $patList = fetchAll('patient');
    }
    if(isset($_GET['update']))
        $data = fetch($_GET['page'], $_GET['id']);
    require "page/form.php";
}

function show(){
    if($_GET['page'] == 'medecin')
        $speList = request("SELECT DISTINCT specialite FROM medecin");
    $person = fetch($_GET['page'], $_GET['id']);
    $data = fetchAllById('consultation', $_GET['id']);
    require "page/show.php";
}

function error(string $error){
    require "page/error.php";
}