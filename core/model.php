<?php

require "config/database.php";


function fetchCount(string $table)
{
    $sql = "SELECT count(*) as nb FROM $table";
    return request($sql)->fetch()->nb;
}

function fetch(string $table, int $id)
{   
    if($table == "prescription")
        $sql = "SELECT * FROM $table WHERE id_consultation=:id";
    else $sql = "SELECT * FROM $table WHERE id=:id";
    return request($sql, ["id" => $id])->fetch();
}

function fetchAll(string $table)
{
    $sql = "SELECT * FROM $table ORDER BY id DESC";
    return request($sql)->fetchAll();
}

function fetchLast(string $table)
{
    if (fetchCount($table) > 3) {
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 3";
        return request($sql)->fetchAll();
    }
    return fetchAll($table);
}

function fetchPage(string $table, ?int $page = 0)
{
    $pos = $page * 12;
    $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT $pos, 12";
    return request($sql)->fetchAll();
}

function fetchAllById(string $table, int $id)
{
    if($_GET['page'] == 'patient')
        $sql = "SELECT * FROM $table WHERE id_dossier =:id ORDER BY id DESC";
    else
        $sql = "SELECT * FROM $table WHERE id_medecin =:id ORDER BY id DESC";

    return request($sql, ['id' => $id])->fetchAll();
}

function delete(string $table, int $id)
{
    $sql = "DELETE FROM $table WHERE id=:id";
    return request($sql, ["id" => $id]);
}

function searchByKeyord($page, $keyword){
    
    $p = request("SELECT * FROM patient 
                  WHERE nom LIKE '%{$_GET['q']}%' 
                  OR prenom LIKE '%{$_GET['q']}%'"
                )->fetchAll();

    if($page == 'dashboard'){
        $m = request("SELECT * FROM medecin 
                      WHERE nom LIKE '%{$_GET['q']}%' 
                      OR prenom LIKE '%{$_GET['q']}%'"
                    )->fetchAll();

        return array_merge($m, $p);
    }

    if($page == 'medecin'){
        return request("SELECT * FROM medecin 
                        WHERE specialite LIKE '%{$_GET['q']}%' 
                        OR prenom LIKE '%{$_GET['q']}%'"
                    )->fetchAll();
    }

    return $p;
}


function save(string $table, array $data)
{
    switch ($table) {
        case 'patient':
            $sql = "INSERT INTO patient (code, nom, prenom, sexe, tel, adresse) 
                VALUES (:code, :nom, :prenom, :sexe, :tel, :adresse)";
            break;
        case 'medecin';
            $sql = "INSERT INTO medecin (nom, prenom, sexe, tel, adresse, email, specialite) 
                VALUES (:nom, :prenom, :sexe, :tel, :adresse, :email, :specialite)";
            break;
        case 'prescription';
            $sql = "INSERT INTO prescription (id_consultation, prescription) 
                VALUES (:id_consultation, :prescription)";
            break;
        case 'consultation';
            $sql = "INSERT INTO consultation (id_medecin, id_dossier, poids, hauteur, diagnostique) 
                VALUES (:id_medecin, :id_dossier, :poids, :hauteur, :diagnostique)";
            break;
    }
    return request($sql, $data);
}

function update(string $table, array $data)
{
    switch ($table) {
        case 'patient':
            $sql = "UPDATE patient SET 
            code =:code, nom =:nom, prenom=:prenom, 
            sexe =:sexe, tel =:tel, adresse = :adresse
            WHERE id=:id";
            break;
        case 'medecin';
            $sql = "UPDATE medecin SET 
            nom =:nom, prenom=:prenom, sexe =:sexe, tel =:tel, 
            adresse = :adresse, email =:email, specialite =:specialite
            WHERE id=:id";
            break;
    }
    return request($sql, $data);
}
