<?php

include "db.php";

// Add notification

session_start();
if (isset($_SESSION["message"])) {
    setcookie("message", $_SESSION["message"], time() + 10);
    unset($_SESSION["message"]);
}

// Create

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if (isset($_POST["id_invoice"])) {
    $id_invoice = $_POST["id_invoice"];
    settype($id_invoice, "integer");
    if (is_null($id_invoice)) {
        $id_invoice = 0;
    }
}
if (isset($_POST["type_doc"])) {
    $type_doc = $_POST["type_doc"];
    settype($type_doc, "integer");
    if (is_null($type_doc)) {
        $type_doc = 0;
    }
}
if (isset($_POST["name_doc"])) {
    $name_doc = $_POST["name_doc"];
}
if (isset($_POST["data_doc"])) {
    $data_doc = $_POST["data_doc"];
    $timestamp = strtotime($data_doc);
    $formatted_date = date("m/d/Y", $timestamp);
}
if (isset($_POST["blank_cod"])) {
    $blank_cod = $_POST["blank_cod"];
}
if (isset($_POST["seria"])) {
    $seria = $_POST["seria"];
}
if (isset($_POST["numdoc"])) {
    $numdoc = $_POST["numdoc"];
}
if (isset($_POST["descript_d"])) {
    $descript_d = $_POST["descript_d"];
}
if (isset($_POST["n_plat_t"])) {
    $n_plat_t = $_POST["n_plat_t"];
}

if (isset($_POST["add"])) {
    $sql = ("INSERT INTO inv_docs(id_invoice, type_doc, name_doc, data_doc, blank_cod, seria, numdoc, descript_d, n_plat_t) VALUES(?,?,?,?,?,?,?,?,?)");
    $query = $pdo->prepare($sql);
    $query->execute([$id_invoice, $type_doc, $name_doc, $formatted_date, $blank_cod, $seria, $numdoc, $descript_d, $n_plat_t]);
    if ($query) {
        $_SESSION["message"] = "The record was successfully added!";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}


// Read

$sql = $pdo->prepare("SELECT * FROM inv_docs");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);


// Delete

if (isset($_POST["delete"])) {
    $sql = ("DELETE FROM inv_docs WHERE id = ?");
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    if ($query) {
        $_SESSION["message"] = "The record was successfully deleted!";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}


// Update

if (isset($_POST["edit"])) {
    $sql = ("UPDATE inv_docs SET id_invoice=?, type_doc=?, name_doc=?, data_doc=?, blank_cod=?, seria=?, numdoc=?, descript_d=?, n_plat_t=? WHERE id = ?");
    $query = $pdo->prepare($sql);
    $query->execute([$id_invoice, $type_doc, $name_doc, $formatted_date, $blank_cod, $seria, $numdoc, $descript_d, $n_plat_t, $id]);
    if ($query) {
        $_SESSION["message"] = "The record was successfully updated!";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

// Pagination

$currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
$recordsPerPage = 10;
$totalRecords = count($result);
$totalPages = ceil($totalRecords / $recordsPerPage);
$offset = ($currentPage - 1) * $recordsPerPage;
$pagesToShow = array();
$radius = 5;
$pagesToShow[] = 1;
if ($currentPage > $radius + 1) {
    $pagesToShow[] = "...";
}
for ($i = $currentPage - $radius; $i <= $currentPage + $radius; $i++) {
    if ($i > 1 && $i < $totalPages) {
        $pagesToShow[] = $i;
    }
}
if ($currentPage < $totalPages - $radius) {
    $pagesToShow[] = "...";
}
$pagesToShow[] = $totalPages;

$prevPage = $currentPage > 1 ? $currentPage - 1 : 1;
$nextPage = $currentPage < $totalPages ? $currentPage + 1 : $totalPages;
$prevDisabled = $currentPage == 1 ? "disabled" : "";
$nextDisabled = $currentPage == $totalPages ? "disabled" : "";

$recordsOnCurrentPage = $totalRecords - ($currentPage - 1) * $recordsPerPage;
if ($recordsOnCurrentPage <= 0) {
    $prevPage = $currentPage > 1 ? $currentPage - 1 : 1;
    header("Location: ?page=$prevPage");
}