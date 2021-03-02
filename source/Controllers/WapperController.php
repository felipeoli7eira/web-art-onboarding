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

        public function home()
        {
            $wappers = $this->wapperModel->all();

            view('home', ['wappers' => $wappers]);
        }
    }