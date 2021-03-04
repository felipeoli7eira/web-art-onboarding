<?php

    /**
     * @class WapperController
     * 
     * Controlador de wapper
     * 
     * @author Felipe Oliveira <felipe.oliveira@wapstore.com.br>
    */

    namespace Source\Controllers;

    use Source\Models\WapperModel;

    class WapperController
    {
        /**
         * Armazena a instância do modelo WapperModel
         * @var Source\Models\WapperModel $wapperModel
         * */
        private $wapperModel;

        /**
         * Tipos permitidos de arquivos para upload
         * @var array $allowedFileTypes
         * */
        private array $allowedFileTypes = ['image/jpg', 'image/png', 'image/jpeg'];

        public function __construct()
        {
            $this->wapperModel = new WapperModel();
        }

        /**
         * Busca todos os wappers no banco e exibe a view "home" para o endpoint / (raiz)
         * @method home()
         * @return void
        */
        public function home(): void
        {
            $wappers = $this->wapperModel->all();

            view('home', ['wappers' => $wappers]);
        }

        /**
         * Exibe a view form-create para cadastro de novo wapper
         * @method htmlFormCreate()
         * @return void
        */
        public function htmlFormCreate(): void
        {
            view('form-create');
        }

        /**
         * Cadastra um novo wapper
         * @method createWapper()
         * @param array $requestData
         * @param null|array $requestFiles
         * @return mixed
        */
        public function createWapper(array $requestData, ?array $requestFiles = null)
        {
            if (
                !empty($requestFiles) &&
                array_key_exists('photo', $requestFiles) &&
                array_key_exists('name', $requestFiles['photo'])
            )
            {
                $upload = $this->upload($requestFiles) ?? null;
            }

            $filtered = [];

            foreach ($requestData as $key => $value) {

                $filtered [ $key ] = is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            $filtered['photo'] = $upload;

            $created = $this->wapperModel->insert($filtered);

            if ($created) {

                header('HTTP/1.1 302 Redirect');
                header('Location: ' . url());
            }
            else {

                // por enquando !!!
                echo '<h1>Erro inesperado! tente mais tarde.</h1>', '<nav><a href="' . url() . '">home</a></nav>';
            }
        }

        /**
         * Faz o upload para a pasta storage, retorna o nome do arquivos em caso de sucesso ou false em casos de erro
         * 
         * @param array $requestFile
         * @return string|bool
        */
        public function upload(array $requestFile)
        {
            $file = $requestFile['photo'];

            if (in_array($file['type'], $this->allowedFileTypes))
            {
                /**
                 * O resultado da @var string $timeName será parecido com: upload-03-03-2021-17h44m53s-timestamp-1614804293
                */
                $timeName = 'upload-' . date('d-m-Y-H\hi\ms\s') . '-timestamp-' . time();
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

                $fileUploadName = $timeName . '.' . $extension;

                $move = move_uploaded_file($file['tmp_name'], CONF_UPLOADS_PATH . $fileUploadName);

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
