<?php

require_once __DIR__ . '/../../database/SettingsVat.php';

// create entity
$settingsVat = new SettingsVat();

// check for method
if (get_request_method() == 'POST') {
    // grab data from form inputs

    $settingsVat->language_id->value = getLocaleId($locale);
    $settingsVat->name->value = htmlspecialchars($_POST[$settingsVat->name->name] ?? '');
    $settingsVat->rate->value = htmlspecialchars($_POST[$settingsVat->rate->name] ?? '');

    // check if given data is ok
    $checks = $settingsVat->name->check() || $settingsVat->rate->check();

    if ($checks) {
        // convert DateTime object to string

        $created_at = date($datetime_format, $settingsVat->created_at->value->getTimestamp());
        $updated_at = date($datetime_format, $settingsVat->updated_at->value->getTimestamp());

        // get all locale id to create this entity for each one of them
        $all_locale_id = getAllLocaleId();
        foreach ($all_locale_id as $locale_id) {
            // sql statement
            $stmt = $pdo->prepare("INSERT INTO settings_vat (language_id, name, rate, created_at, updated_at)
                                     VALUES (:language_id, :name, :rate, :created_at, :updated_at)");

            //  bind values and parameters
            $stmt->bindValue(':language_id', $locale_id['id'], PDO::PARAM_INT);
            $stmt->bindParam(':name', $settingsVat->name->value, PDO::PARAM_STR);
            $stmt->bindParam(':rate', $settingsVat->rate->value, PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);

            // flush database
            $stmt->execute();

            // close the statement
            $stmt->closeCursor();
        }

        // redirect to index page if everything is successfull
        header("Location: " . get_server() . "?locale=$locale&page=settings_vat");
    }

    // this will open the current page so no reason to redirect again
}

// show form field
include_once __DIR__ . '/_form.php';
