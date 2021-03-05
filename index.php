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

            case '/wapper': /** CREATE */

                $wapperController->insert($_POST, $_FILES);
            break;

            case '/d': /** DELETE */

                $wapperController->destroy();
            break;

            case '/edit': /** UPDATE */

                $wapperController->edit();
            break;

            default:

                view('notification', ['text' => 'Solicitação não encontrada', 'image' => 'undraw_server.svg']);
        }
    }
    else {

        $wapperController->home(); /** READ ALL */
    }
