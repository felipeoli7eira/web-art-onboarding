<?php

    namespace Source\Controllers;

    use Source\Models\WapperModel;

    class WapperController
    {
        /** @var Source\Models\WapperModel $wapperModel */
        private $wapperModel;

        public function __construct()
        {
            $this->wapperModel = new WapperModel();
        }

        /**
         * @return void
        */
        public function home(): void
        {
            $wappers = $this->wapperModel->all();

            view('home', ['wappers' => $wappers]);
        }

        /**
         * @return void
        */
        public function htmlFormCreate(): void
        {
            view('form-create');
        }

        /**
         * @param array $requestData
         * @param array $requestFiles
         * @return mixed
        */
        public function createWapper(array $requestData, ?array $requestFiles)
        {
            var_dump($requestData, $requestFiles);
        }
    }