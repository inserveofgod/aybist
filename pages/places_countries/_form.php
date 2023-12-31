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
                                <a href="<?= "/$locale/places_countries" ?>"><?= $lang['page_places_countries'] ?></a>
                            </li>
                            <li class="breadcrumb-item active">
                                <?= ($id <= 0) ? $lang['text_new'] : $lang['text_update'] ?>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="<?= "/$locale/places_countries/" . (($id <= 0) ? "create" : "update/$id") ?>" method="post">
                            <div class="row gx-md-4 gx-0 gy-4 mb-3 align-items-baseline">
                                <div class="col-md-6">
                                    <label class="form-label" for="<?= $countries->country->name ?>">
                                        <?= $lang['label_country'] ?>
                                        <span class="text-danger"><?= ($countries->country->required) ? '*': '' ?></span>
                                    </label>
                                    <input class="form-control" placeholder="<?= $lang['placeholder_country'] ?>" <?= $countries->country->get_attr() ?>>
                                    <span class="text-danger"><?= ($countries->country->error_msg) ?></span>
                                    <span class="text-muted"><?= ($countries->country->help_msg) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="<?= $countries->phone_code->name ?>">
                                        <?= $lang['label_phone_code'] ?>
                                        <span class="text-danger"><?= ($countries->phone_code->required) ? '*': '' ?></span>
                                    </label>
                                    <input class="form-control" placeholder="<?= $lang['placeholder_phone_code'] ?>" <?= $countries->phone_code->get_attr() ?>>
                                    <span class="text-danger"><?= ($countries->phone_code->error_msg) ?></span>
                                    <span class="text-muted"><?= ($countries->phone_code->help_msg) ?></span>
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
