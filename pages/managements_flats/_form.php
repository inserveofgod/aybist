<section class="forms">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <nav style="--bs-breadcrumb-divider: '>'">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= "/$locale/home" ?>"><?= $lang['page_home'] ?></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= "/$locale/managements_flats" ?>"><?= $lang['page_managements_flats'] ?></a>
                            </li>
                            <li class="breadcrumb-item active">
                                <?= ($id <= 0) ? $lang['text_new'] : $lang['text_update'] ?>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="<?= "/$locale/managements_flats/" . (($id <= 0) ? "create" : "update/$id") ?>" method="post">
                            <div class="row gx-md-4 gx-0 gy-4 mb-3 align-items-baseline">
                                <div class="col-md-6">
                                    <label class="form-label" for="<?= $flats->flat->name ?>">
                                        <?= $lang['label_flat'] ?>
                                        <span class="text-danger"><?= ($flats->flat->required) ? '*': '' ?></span>
                                    </label>
                                    <input class="form-control" placeholder="<?= $lang['placeholder_flat'] ?>" <?= $flats->flat->get_attr() ?>>
                                    <span class="text-danger"><?= ($flats->flat->error_msg) ?></span>
                                    <span class="text-muted"><?= ($flats->flat->help_msg) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="<?= $flats->square_meter->name ?>">
                                        <?= $lang['label_square_meter'] ?>
                                        <span class="text-danger"><?= ($flats->square_meter->required) ? '*': '' ?></span>
                                    </label>
                                    <input class="form-control" placeholder="<?= $lang['placeholder_square_meter'] ?>" <?= $flats->square_meter->get_attr() ?>>
                                    <span class="text-danger"><?= ($flats->square_meter->error_msg) ?></span>
                                    <span class="text-muted"><?= ($flats->square_meter->help_msg) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <div class="row gx-md-4 gx-0 gy-4 align-items-end">
                                        <div class="col-4">
                                            <label class="form-label" for="<?= $flats->fee->name ?>">
                                                <?= $lang['label_fee'] ?>
                                                <span class="text-danger"><?= ($flats->fee->required) ? '*': '' ?></span>
                                            </label>
                                            <select class="form-select" <?= $flats->currency_id->get_attr() ?>>
                                                <?php
                                                    $options = $flats->currency_id->get_select_options($lang['placeholder_currency_select']);
                                                    foreach ($options as $option) {
                                                        echo $option . PHP_EOL;
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-8">
                                            <input class="form-control" placeholder="<?= $lang['placeholder_fee'] ?>" <?= $flats->fee->get_attr() ?>>
                                            <span class="text-danger"><?= ($flats->fee->error_msg) ?></span>
                                            <span class="text-muted"><?= ($flats->fee->help_msg) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= ($id <= 0) ? $lang['text_create'] : $lang['text_update'] ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
