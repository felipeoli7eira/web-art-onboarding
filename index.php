<?php

    require __DIR__ . '/source/autoload.php';

    use Source\Controllers\WapperController;

    $wapperController = new WapperController();

    if (array_key_exists('route', $_GET)) {

        $path = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS);

        switch ($path) {

            case '/novo':

                $wapperController->htmlFormCreate();
            break;

            case '/wapper':

                $wapperController->createWapper($_POST, $_FILES);
            break;

            default:

                view('notification', ['text' => 'Solicitação não encontrada', 'image' => 'undraw_server.svg']);
        }
    }
    else {

        $wapperController->home();
    }
