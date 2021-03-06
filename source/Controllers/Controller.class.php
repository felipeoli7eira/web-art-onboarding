<?php

    namespace Source\Controllers;

    class Controller
    {
        /**
         * Retorna o verbo da requisição
         * @method string getRequestMethod()
         * @return string
        */
        protected function getRequestMethod(): string
        {
            return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
        }

        /**
         * Verifica se é um inteiro válido (para ID)
         * @method validInt()
         * @return bool
        */
        protected function validInt($arg): bool
        {
            return filter_var($arg, FILTER_VALIDATE_INT);
        }

        /**
         * Faz o upload para a pasta storage, retorna o nome do arquivo em caso de sucesso ou false em casos de erro
         * 
         * @method upload()
         * @param array $files
         * @return string|bool
        */
        protected function upload(array $files)
        {
            $photo = $files['photo'];

            if (in_array($photo['type'], static::$allowedFileTypes /** parâmetro da classe filha */ ))
            {
                /**
                 * O resultado da @var string $timeName será parecido com: upload-03-03-2021-17h44m53s-timestamp-1614804293
                */
                $timeName = 'upload-' . date('d-m-Y-H\hi\ms\s') . '-timestamp-' . time();
                $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);

                $fileUploadName = $timeName . '.' . $extension;
                $move = move_uploaded_file($photo['tmp_name'], CONF_UPLOADS_PATH . $fileUploadName);

                if ($move)
                {
                    return $fileUploadName;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
    }