<?php

    /**
     * @class Controller
     * 
     * Controlador Base - Responsavél por conter métodos úteis para qualquer Controller
     * 
     * @author Felipe Oliveira
    */

    namespace Source\Controllers;

    class Controller
    {
        /**
         * Retorna o verbo da requisição
         * @method getRequestMethod()
         * @return string
        */
        protected function getRequestMethod(): string
        {
            return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
        }

        /**
         * Verifica se o parâmetro é um inteiro válido
         * @method validInt()
         * @param string|int $argument
         * @return bool
        */
        protected function validInt($argument): bool
        {
            return filter_var($argument, FILTER_VALIDATE_INT);
        }

        /**
         * Faz o upload para a pasta storage, retorna o nome do arquivo em caso de sucesso ou false em casos de erro
         * @method upload()
         * @param array $files
         * @return string|bool
        */
        protected function upload(array $files)
        {
            $photo = $files['photo'];

            if (in_array($photo['type'], static::$allowedFileTypes /** parâmetro da classe filha */ )) {
                /**
                 * O resultado da @var string $timeName será parecido com: upload-03-03-2021-17h44m53s-timestamp-1614804293
                */
                $timeName = 'upload-' . date('d-m-Y-H\hi\ms\s') . '-timestamp-' . time();
                $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);

                $fileUploadName = $timeName . '.' . $extension;
                $move = move_uploaded_file($photo['tmp_name'], CONF_UPLOADS_PATH . $fileUploadName);

                if ($move) {
                    return $fileUploadName;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }

        /**
         * Cria um cookie com uma mensagem para ser exibida no front
         * @method setResponseToFront()
         * @param string $message
         * @return void
        */
        protected function setResponseToFront(string $message): void
        {
            setcookie('we_b_operation_response', $message, time() + 5, '/');
        }
    }