<?php

include 'db.php';

if (isset($_GET["id"])) {
    $get_id = $_GET['id'];
}
if (isset($_POST["id_invoice"])) {
    $id_invoice = $_POST['id_invoice'];
    settype($id_invoice, 'integer');
    if (is_null($id_invoice)) {
        $id_invoice = 0;
    }
}
if (isset($_POST["type_doc"])) {
    $type_doc = $_POST['type_doc'];
    settype($type_doc, 'integer');
    if (is_null($type_doc)) {
        $type_doc = 0;
    }
}
if (isset($_POST["name_doc"])) {
    $name_doc = $_POST['name_doc'];
}
if (isset($_POST["data_doc"])) {
    $data_doc = $_POST['data_doc'];
    $timestamp = strtotime($data_doc);
    $formatted_date = date("m/d/Y", $timestamp);
}
if (isset($_POST["blank_cod"])) {
    $blank_cod = $_POST['blank_cod'];
}
if (isset($_POST["seria"])) {
    $seria = $_POST['seria'];
}
if (isset($_POST["numdoc"])) {
    $numdoc = $_POST['numdoc'];
}
if (isset($_POST["descript_d"])) {
    $descript_d = $_POST['descript_d'];
}
if (isset($_POST["n_plat_t"])) {
    $n_plat_t = $_POST['n_plat_t'];
}


if (isset($_POST["add"])) {
    $sql = ("INSERT INTO inv_docs (id_invoice, type_doc, name_doc, data_doc, blank_cod, seria, numdoc, descript_d, n_plat_t) VALUES (?,?,?,?,?,?,?,?,?)");
    $query = $pdo->prepare($sql);
    $query->execute([$id_invoice, $type_doc, $name_doc, $formatted_date, $blank_cod, $seria, $numdoc, $descript_d, $n_plat_t]);
//    if ($query) {
//        header("Location: " . $_SERVER['HTTP_REFERER']);
//        echo $id_invoice;
//        echo $type_doc;
//    }
}