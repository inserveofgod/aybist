<?php

$data = [];


if ($language_id > 0) {
    $stmt = $pdo->prepare("SELECT d.id, c.city, d.district, d.created_at, d.updated_at
    FROM districts d
    INNER JOIN cities c ON c.id = d.city_id
    INNER JOIN countries co ON co.id = c.country_id
    WHERE co.language_id = :language_id");
    $stmt->bindParam(':language_id', $language_id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
}

?>

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
                                <?= $lang['page_places_districts'] ?>
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
                                    <th><?= $lang['table_city'] ?></th>
                                    <th><?= $lang['table_district'] ?></th>
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
                                        <td data-bs-toggle="tooltip" title="<?= $datum['city'] ?>"><?= substr($datum['city'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['city'] ?? '') > $max_abbr) ? '...' : '' ?></td>
                                        <td data-bs-toggle="tooltip" title="<?= $datum['district'] ?>"><?= substr($datum['district'] ?? '', 0, $max_abbr) ?><?= (strlen($datum['district'] ?? '') > $max_abbr) ? '...' : '' ?></td>
                                        <td><?= date($datetime_format, strtotime($datum['created_at'])); ?></td>
                                        <td><?= date($datetime_format, strtotime($datum['updated_at'])); ?></td>
                                        <td class="col-1">
                                            <a href="<?= "/$locale/places_districts/read/$data_id" ?>">
                                                <i class="ti ti-eye" title="<?= $lang['text_read'] ?>" data-bs-toggle="tooltip"></i>
                                            </a>
                                            <a href="<?= "/$locale/places_districts/update/$data_id" ?>">
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
                    <a class="btn btn-primary" href="<?= "/$locale/places_districts/create" ?>"><?= $lang['text_new'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
