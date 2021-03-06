<?php

    function url(?string $string = null): string
    {
        if ( !is_null($string)) {

            return CONF_URL_BASE . ( $string[0] === '/' ? $string : '/' . $string );
        }

        return CONF_URL_BASE;
    }

    function asset(string $asset): string
    {
        return url() . '/assets/' . $asset;
    }

    function view(string $viewName, ?array $data = []): void
    {
        # extract($data);

        if (sizeof($data) > 0) {

            foreach ($data as $varName => $value) {
                $$varName = $value;
            }
        }

        /** html head */
        require __DIR__ . '/../../views/html/open.php';

        /** html body */
        require __DIR__ . '/../../views/' . $viewName . '.php';

        /** html close */
        require __DIR__ . '/../../views/html/close.php';
    }

    function redirect(string $path): void
    {
        header('HTTP/1.1 302 Redirect');
        header('Location: ' . $path);
    }