<?php

    namespace Source\Controllers;

    class Controller
    {
        /**
         * Retorna o verbo da requisição
         * @method string requestMethod()
         * @return string
        */
        protected function requestMethod(): string
        {
            return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
        }

        protected function validInt($arg): bool
        {
            return filter_var($arg, FILTER_VALIDATE_INT);
        }
    }