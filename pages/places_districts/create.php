<?php

// create entity
$districts = new Districts();

// check for method
if (Helpers::getRequestMethod() == 'POST') {
    try {
        // grab data from form inputs

        $districts->city_id->value = htmlspecialchars($_POST[$districts->city_id->name] ?? '');
        $districts->district->value = htmlspecialchars($_POST[$districts->district->name] ?? '');

        // check if given data is ok
        $checks = $districts->city_id->check() && $districts->district->check();

        if ($checks) {
            // convert DateTime object to string

            $created_at = date($datetime_format, $districts->created_at->value->getTimestamp());
            $updated_at = date($datetime_format, $districts->created_at->value->getTimestamp());

            // sql statement
            $stmt = $pdo->prepare("INSERT INTO districts (city_id, district, created_at, updated_at)
                                        VALUES (:city_id, :district, :created_at, :updated_at)");

            //  bind values and parameters
            $stmt->bindParam(':city_id', $districts->city_id->value, PDO::PARAM_INT);
            $stmt->bindParam(':district', $districts->district->value, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);

            // flush database
            $stmt->execute();

            // close the statement
            $stmt->closeCursor();

            // redirect to index page if everything is successfull
            Flash::addFlash($lang['flash_success_created'], 'success');
            Helpers::redirect($page);
        }
    }

    catch (PDOException $e) {
        // show error message
        Flash::addFlash($lang['flash_fail_created'], 'danger');
        Helpers::redirect("$page/create");
    }

    // this will open the current page so no reason to redirect again
}

// show form field
include_once __DIR__ . '/_form.php';
