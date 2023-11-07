<?php include './src/php/foo.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
<div class="page">

    <!--    Modal Add Record  -->
    <div class="modal fade" id="modalWindowAddRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Add a record to the table</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-add-record" method="post">
                    <div class="mb-4 row">
                        <div class="col">
                            <label for="invoice" class="form-label">Invoice id</label>
                            <input type="text" class="form-control form-control-invoice" id="invoice" name="id_invoice"
                                   aria-describedby="invoiceHelp">
                            <div id="invoiceHelp" class="form-text d-none invalid-feedback">This field must be numeric
                            </div>
                        </div>
                        <div class="col">
                            <label for="typeDoc" class="form-label">Type document</label>
                            <input type="text" class="form-control form-control-typedoc" id="typeDoc" name="type_doc"
                                   aria-describedby="typeDocHelp">
                            <div id="typeDocHelp" class="form-text d-none invalid-feedback">This field must be numeric
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label for="nameDoc" class="form-label">Name document</label>
                            <input type="text" class="form-control" name="name_doc" id="name_doc">
                        </div>
                        <div class="col">
                            <label for="dateDoc" class="form-label">Date document</label>
                            <input id="dateDoc" name="data_doc" class="form-control" type="date"/>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label for="blank" class="form-label">Blank</label>
                            <input type="text" class="form-control" name="blank_cod" id="blank">
                        </div>
                        <div class="col">
                            <label for="seria" class="form-label">Seria</label>
                            <input id="seria" class="form-control" name="seria" type="text"/>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label for="numDoc" class="form-label">Numdoc</label>
                            <input type="text" class="form-control" name="numdoc" id="numDoc">
                        </div>
                        <div class="col">
                            <label for="plat" class="form-label">Plat</label>
                            <input id="plat" class="form-control" name="n_plat_t" type="text"/>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control form__textarea" name="descript_d" id="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary add-record-btn validate-btn" id="liveToastBtn"
                            name="add">Add
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container-xl">
        <div class="table-bar mb-3">
            <!--    Open modal add record button   -->
            <button type="button" class="btn btn-primary open-modal-window-btn" data-bs-toggle="modal"
                    data-bs-target="#modalWindowAddRecord">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                     viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                </svg>
            </button>
        </div>
        <div class="table-wrapper">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Id invoice</th>
                    <th scope="col">Type document</th>
                    <th scope="col">Name document</th>
                    <th scope="col">Data document</th>
                    <th scope="col">Blank</th>
                    <th scope="col">Seria</th>
                    <th scope="col">Numdoc</th>
                    <th scope="col">Description</th>
                    <th scope="col">Plat</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i = $offset; $i < min($offset + $recordsPerPage, $totalRecords); $i++) {
                    $res = $result[$i]; ?>

                    <!--    Modal Edit Record   -->
                    <div class="modal fade" id="modalWindowEditRecord<?php echo $res->id; ?>" data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Edit a record to the
                                        table</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="?id=<?php echo $res->id; ?>" class="form-add-record" method="post">
                                    <div class="mb-4 row">
                                        <div class="col">
                                            <label for="invoice" class="form-label">Invoice id</label>
                                            <input value="<?php echo $res->id_invoice; ?>" type="text"
                                                   class="form-control form-control-invoice" id="invoice"
                                                   name="id_invoice" aria-describedby="invoiceHelp">
                                            <div id="invoiceHelp" class="form-text d-none invalid-feedback">This field
                                                must
                                                be numeric
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="typeDoc" class="form-label">Type document</label>
                                            <input value="<?php echo $res->type_doc; ?>" type="text"
                                                   class="form-control form-control-typedoc" id="typeDoc"
                                                   name="type_doc" aria-describedby="typeDocHelp">
                                            <div id="typeDocHelp" class="form-text d-none invalid-feedback">This field
                                                must
                                                be numeric
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <div class="col">
                                            <label for="nameDoc" class="form-label">Name document</label>
                                            <input value="<?php echo $res->name_doc; ?>" type="text"
                                                   class="form-control"
                                                   name="name_doc" id="nameDoc"/>
                                        </div>
                                        <div class="col">
                                            <label for="dateDoc" class="form-label">Date document</label>
                                            <input value="<?php echo date('Y-m-d', strtotime($res->data_doc)); ?>"
                                                   id="dateDoc" name="data_doc"
                                                   class="form-control" type="date"/>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <div class="col">
                                            <label for="blank" class="form-label">Blank</label>
                                            <input value="<?php echo $res->blank_cod; ?>" type="text"
                                                   class="form-control"
                                                   name="blank_cod" id="blank">
                                        </div>
                                        <div class="col">
                                            <label for="seria" class="form-label">Seria</label>
                                            <input value="<?php echo $res->seria; ?>" id="seria" class="form-control"
                                                   name="seria"
                                                   type="text"/>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <div class="col">
                                            <label for="numDoc" class="form-label">Numdoc</label>
                                            <input value="<?php echo $res->numdoc; ?>" type="text" class="form-control"
                                                   name="numdoc"
                                                   id="numDoc">
                                        </div>
                                        <div class="col">
                                            <label for="plat" class="form-label">Plat</label>
                                            <input value="<?php echo $res->n_plat_t; ?>" id="plat" class="form-control"
                                                   name="n_plat_t"
                                                   type="text"/>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control form__textarea" name="descript_d"
                                                  id="description"><?php echo $res->descript_d; ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary edit-record-btn validate-btn"
                                            id="liveToastBtn" name="edit">Apply
                                        changes
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--    Modal Delete Record  -->
                    <div class="modal fade" id="modalWindowDeleteRecord<?php echo $res->id; ?>"
                         data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Delete a record
                                        № <?php echo $res->id; ?></h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="?id=<?php echo $res->id; ?>" method="post">
                                    <p class="delete-form-text">Are you sure you want to delete?</p>
                                    <div class="row gap-2">
                                        <button type="button" class="col btn btn-primary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="col btn btn-danger delete-record-btn"
                                                name="delete">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <td><?php echo $res->id; ?></td>
                        <td><?php echo $res->id_invoice; ?></td>
                        <td><?php echo $res->type_doc; ?></td>
                        <td><?php echo $res->name_doc; ?></td>
                        <td><?php echo $res->data_doc; ?></td>
                        <td><?php echo $res->blank_cod; ?></td>
                        <td><?php echo $res->seria; ?></td>
                        <td><?php echo $res->numdoc; ?></td>
                        <td><?php echo $res->descript_d; ?></td>
                        <td><?php echo $res->n_plat_t; ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="?id=<?php echo $res->id; ?>"
                                   data-bs-target="#modalWindowEditRecord<?php echo $res->id; ?>"
                                   type="button" class="btn btn-success open-modal-edit-record-btn"
                                   data-bs-toggle="modal"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                </a>
                                <a href="" data-bs-target="#modalWindowDeleteRecord<?php echo $res->id; ?>"
                                   type="button" class="btn btn-danger open-modal-delete-record-btn"
                                   data-bs-toggle="modal"

                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <!--      Pagination   -->
        <ul class="pagination">
            <li class="page-item active <?= $prevDisabled ?>">
                <a class="page-link" href="?page=<?= $prevPage ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <?php foreach ($pagesToShow as $page) : ?>
                <?php if ($page == "...") : ?>
                    <li class="page-item dost-disabled">
                        <span class="page-link">…</span>
                    </li>
                <?php else : ?>
                    <li class="page-item <?php if ($page == $currentPage) echo "active"; ?>">
                        <a href="?page=<?= $page ?>"
                           class="page-link"><?php echo $page; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <li class="page-item active <?= $nextDisabled ?>">
                <a class="page-link" href="?page=<?= $nextPage ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </div>

    <!--        Notification if added new record was successfull  -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="https://cdn3.iconfinder.com/data/icons/round-default/64/add-512.png"
                     class="rounded me-2 toast__svg" alt="success svg">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close btn-close-toast" data-bs-dismiss="toast"
                        aria-label="close-toast"></button>
            </div>
            <div class="toast-body" id="toast-message">
                The record was successfully added!
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./src/js/validate.js"></script>
<script src="./src/js/notification.js"></script>
</body>
</html>