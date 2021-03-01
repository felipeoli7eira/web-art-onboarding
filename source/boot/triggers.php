<?php

    function url(string $string): string
    {
        return CONF_URL_BASE . ( $string[0] === '/' ? $string : '/' . $string );
    }