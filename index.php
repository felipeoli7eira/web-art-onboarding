<?php

    // ini_set('error_reporting', E_ALL); // ?
    // ini_set('display_errors', 1); // ?

    require __DIR__ . '/source/autoload.php';

    use Source\Controllers\WapperController;

    $wapperController = new WapperController();

    $route = array_key_exists('route', $_GET);
    $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);

    if ($route) {

        $path = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS);

        switch ($path) {

            case '/novo-wapper' && $requestMethod === 'GET':

                $wapperController->htmlFormCreate();

            break;

            case '/wapper' && $requestMethod === 'POST':

                $wapperController->createWapper($_POST, $_FILES);

            break;

            default:

                echo "<h1>404 - Solicitação não encontrada</h1>";
                # implementar página de erro: $wapperController->notFound();

            break;
        }
    }
    else {

        if ($requestMethod === 'GET') {

            $wapperController->home();
            return;
        }

        echo "<h1>404 - Solicitação não encontrada</h1>";
        # implementar página de erro: $wapperController->notFound();
    }
