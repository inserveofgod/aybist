<?php

$datum = [];


if ($language_id > 0) {
    $stmt = $pdo->prepare("SELECT c.id, co.country, c.city, c.zip_code, c.created_at, c.updated_at
    FROM cities c
    INNER JOIN countries co ON co.id = c.country_id
    WHERE co.language_id = :language_id AND c.id = :id");
    $stmt->bindParam(':language_id', $language_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $datum = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
}

?>

<section class="datatables">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <nav style="--bs-breadcrumb-divider: '>'">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= "/$locale/home" ?>"><?= $lang['page_home'] ?></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= "/$locale/places_cities" ?>"><?= $lang['page_places_cities'] ?></a>
                            </li>
                            <li class="breadcrumb-item active">
                                <?= $datum['id'] ?>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border table-hover table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th data-priority="1">#</th>
                                    <td><?= $datum['id'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= $lang['table_country'] ?></th>
                                    <td><?= $datum['country'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= $lang['table_city'] ?></th>
                                    <td><?= $datum['city'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= $lang['table_zip_code'] ?></th>
                                    <td><?= $datum['zip_code'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= $lang['table_created_at'] ?></th>
                                    <td><?= date($datetime_format, strtotime($datum['created_at'])); ?></td>
                                </tr>
                                <tr>
                                    <th><?= $lang['table_updated_at'] ?></th>
                                    <td><?= date($datetime_format, strtotime($datum['updated_at'])); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary" href="<?= "/$locale/places_cities" ?>"><?= $lang['text_go_back'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
