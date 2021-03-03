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
        public function createWapper(array $requestData, ?array $requestFiles)
        {
            var_dump($requestData, $requestFiles);
        }
    }
