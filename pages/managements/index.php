<?php

$data = [];


if ($language_id > 0) {
    $stmt = $pdo->prepare("SELECT m.id, b.block, f.floor, flat.flat, u.fullname as owner, u2.fullname as rental, m.management, m.description, m.fee_status, m.created_at, m.updated_at
        FROM managements m
        INNER JOIN blocks b ON b.id = m.block_id
        INNER JOIN floors f ON f.id = m.floor_id
        INNER JOIN flats flat ON flat.id = m.flat_id
        INNER JOIN users u ON u.id = m.manager_owner_id
        INNER JOIN users u2 ON u2.id = m.manager_rental_id
        WHERE m.language_id = :language_id"
    );

    $stmt->bindParam(':language_id', $language_id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
}

?>

<div class="container-fluid mw-100">
    <section class="datatables">
        <div class="row gy-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <nav style="--bs-breadcrumb-divider: '>'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= "/$locale/home" ?>"><?= $lang['page_home'] ?></a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <?= $lang['page_managements'] ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border table-hover table-striped table-bordered text-nowrap display datatable">
                                <thead>
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th><?= $lang['table_block'] ?></th>
                                        <th><?= $lang['table_floor'] ?></th>
                                        <th><?= $lang['table_flat'] ?></th>
                                        <th><?= $lang['table_manager_owner'] ?></th>
                                        <th><?= $lang['table_manager_rental'] ?></th>
                                        <th><?= $lang['table_management'] ?></th>
                                        <th><?= $lang['table_description'] ?></th>
                                        <th><?= $lang['table_fee_status'] ?></th>
                                        <th><?= $lang['table_created_at'] ?></th>
                                        <th><?= $lang['table_updated_at'] ?></th>
                                        <th data-priority="1"><?= $lang['table_action'] ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $datum): ?>
                                        <?php $data_id = $datum['id'] ?>
                                        <tr>
                                            <td><?= $data_id ?></td>
                                            <td data-bs-toggle="tooltip" title="<?= $datum['block'] ?>"><?= substr($datum['block'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['block'] ?? '') > $max_abbr) ? '...': '' ?></td>
                                            <td data-bs-toggle="tooltip" title="<?= $datum['floor'] ?>"><?= substr($datum['floor'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['floor'] ?? '') > $max_abbr) ? '...': '' ?></td>
                                            <td data-bs-toggle="tooltip" title="<?= $datum['flat'] ?>"><?= substr($datum['flat'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['flat'] ?? '') > $max_abbr) ? '...': '' ?></td>
                                            <td data-bs-toggle="tooltip" title="<?= $datum['owner'] ?>"><?= substr($datum['owner'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['owner'] ?? '') > $max_abbr) ? '...': '' ?></td>
                                            <td data-bs-toggle="tooltip" title="<?= $datum['rental'] ?>"><?= substr($datum['rental'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['rental'] ?? '') > $max_abbr) ? '...': '' ?></td>
                                            <td data-bs-toggle="tooltip" title="<?= $datum['management'] ?>"><?= substr($datum['management'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['management'] ?? '') > $max_abbr) ? '...': '' ?></td>
                                            <td data-bs-toggle="tooltip" title="<?= $datum['description'] ?>"><?= substr($datum['description'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['description'] ?? '') > $max_abbr) ? '...': '' ?></td>
                                            <td><?= ($datum['fee_status']) ? $lang['text_exempted'] : $lang['text_not_exempted'] ?></td>
                                            <td><?= date($datetime_format, strtotime($datum['created_at'])); ?></td>
                                            <td><?= date($datetime_format, strtotime($datum['updated_at'])); ?></td>
                                            <td class="col-1">
                                                <a href="<?= "/$locale/managements/read/$data_id" ?>">
                                                    <i class="ti ti-eye" title="<?= $lang['text_read'] ?>" data-bs-toggle="tooltip"></i>
                                                </a>
                                                <a href="<?= "/$locale/managements/update/$data_id" ?>">
                                                    <i class="ti ti-pencil" title="<?= $lang['text_edit'] ?>" data-bs-toggle="tooltip"></i>
                                                </a>
                                                <?php
                                                    include __DIR__ . '/_delete_form.php';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-primary" href="<?= "/$locale/managements/create" ?>"><?= $lang['text_new'] ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
