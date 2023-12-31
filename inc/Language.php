<?php

class Language {
    /**
     * returns id of the locale by language code
     * 
     * @param string $locale
     * @return int language_id
     */
    public function getLocaleId(PDO $pdo, string $locale): int {
        $stmt = $pdo->prepare("SELECT id FROM languages WHERE code = :code");
        $stmt->bindParam(":code", $locale, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result['id'] ?? 0;
    }

    /**
     * returns all id of locales in database
     * 
     * @return array id of locales
     */
    public function getAllLocaleId(PDO $pdo): array {
        $stmt = $pdo->prepare("SELECT id FROM languages");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }

    /**
     * returns all locale codes of locales in database
     * 
     * @return array code of locales
     */
    public function getAllLocales(PDO $pdo): array {
        $stmt = $pdo->prepare("SELECT code FROM languages");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }

    /**
     * gets all predefined language variables according to the given language_id
     * 
     * @param int $language_id
     * @return array dictionary of language
     */
    public function getLocaleDict(PDO $pdo, int $language_id): array {
        $stmt = $pdo->prepare("SELECT keyword, value FROM languages_def WHERE language_id = :language_id");
        $stmt->bindParam(':language_id', $language_id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        // format the data according to the lang array
        $formatted_data = [];
        foreach($results as $result) {
            $formatted_data[$result['keyword']] = $result['value'];
        }

        return $formatted_data;
    }

    /**
     * returns new url according to the requested locale
     * 
     * @param string $new_locale
     * @return string request_uri
     */
    function changeLocale(string $new_locale): string {
        $request_uri = Helpers::getRequestUri();
        $queries = explode("/", $request_uri);

        // skip first blank char and locale
        array_shift($queries);
        array_shift($queries);

        return "/$new_locale/" . implode("/", $queries);
    }
}

// initialize language
$language = new Language();

$language_id = $language->getLocaleId($pdo, $locale);
if (!$language_id) {
    $locale = $default_locale;
    $target = $language->changeLocale($locale);
    Helpers::refresh($target);
}

$lang = $language->getLocaleDict($pdo, $language_id);
