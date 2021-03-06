<?php

    /**
     * @class WapperController
     * 
     * Controlador de wapper
     * 
     * @author Felipe Oliveira
    */

    namespace Source\Controllers;

    use Source\Models\WapperModel;

    class WapperController extends Controller
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
        protected static array $allowedFileTypes = ['image/jpg', 'image/png', 'image/jpeg'];

        public function __construct()
        {
            $this->wapperModel = new WapperModel();
        }

        /**
         * Busca todos os wappers no banco e exibe a view "home" para o endpoint GET /
         * @method home()
         * @return void
        */
        public function home(): void
        {
            if ($this->getRequestMethod() === 'GET') {

                $wappers = $this->wapperModel->selectAll();

                view('home', ['wappers' => $wappers]);
                return;
            }

            view('notification', ['text' => 'Solicitação não encontrada']);
        }

        /**
         * Exibe a view form-create para cadastro de novo wapper
         * @method htmlFormCreate()
         * @return void
        */
        public function htmlFormCreate(): void
        {
            if ($this->getRequestMethod() === 'GET') {

                view ('form-create');
            }
            else {

                view ('notification',
                    [
                        'text' => 'Solicitação não encontrada',
                        'image' => 'undraw_server.svg'
                    ]
                );
            }
        }

        /**
         * Cadastra um novo wapper
         * @method insert()
         * @param array $requestData | Dados vindos do $_POST
         * @param null|array $requestFiles | arquivos em $_FILES
         * @return void
        */
        public function insert(array $requestData, ?array $requestFiles = null): void
        {
            if ($this->getRequestMethod() === 'POST') {

                if (
                    !empty($requestFiles) &&
                    array_key_exists('photo', $requestFiles) &&
                    array_key_exists('name', $requestFiles['photo'])
                )
                {
                    $upload = $this->upload($requestFiles);
                }

                $filtered = [];

                foreach ($requestData as $key => $value) {

                    $filtered [ $key ] = is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                }

                $filtered['photo'] = !empty($upload) ? $upload: null;

                $created = $this->wapperModel->insert($filtered);

                if ($created) {

                    header('HTTP/1.1 302 Redirect');
                    header('Location: ' . url());
                    exit();
                }
                else {

                    view('notification', ['text' => 'Algo deu errado, tente novamente daqui a pouco', 'image' => 'undraw_server.svg']);
                }
            }
            else {

                view('notification', ['text' => 'Solicitação não encontrada', 'image' => 'undraw_server.svg']);
            }
        }

        /**
         * Deleta um recurso pelo id
         * 
         * @method destroy()
         * @return void
        */
        public function destroy(): void
        {
            if ($this->getRequestMethod() === 'GET' && array_key_exists( /** wapper id */ 'wid', $_GET)) {

                $id = filter_input(INPUT_GET, 'wid', FILTER_VALIDATE_INT);

                if ($id) {

                    $wapper = $this->wapperModel->getByID($id);

                    if (!is_null($wapper->photo) &&
                        file_exists(CONF_UPLOADS_PATH . $wapper->photo) &&
                        is_file(CONF_UPLOADS_PATH . $wapper->photo)
                    ) {
                        unlink(CONF_UPLOADS_PATH . $wapper->photo);
                    }

                    $deleted = $this->wapperModel->destroy(filter_var($id, FILTER_SANITIZE_STRIPPED));

                    if ($deleted) {
    
                        header('HTTP/1.1 302 Redirect');
                        header('Location: ' . url());
                        exit();
                    }
                    else {

                        view('notification', ['text' => 'Algo deu errado, tente novamente daqui a pouco', 'image' => 'undraw_server.svg']);
                    }
                }
                else {

                    view ('notification', ['text' => 'Dados passados incorretamente, verifique e tente novamente']);
                }
            }
            else {

                view ('notification', ['text' => 'Solicitação não encontrada ou mau formatada']);
            }
        }

        /**
         * Caso a requisição seja GET, chama o formulário de edição
         * Caso a requisição seja POST, executa o update
         * @method edit()
         * @return void
        */
        public function edit()
        {
            /** [ GET REQUEST ] */
            if (
                $this->getRequestMethod() === 'GET' &&
                array_key_exists( /** wapper id */ 'wid', $_GET) &&
                $this->validInt($_GET['wid'])
            )
            {
                $wapper = $this->wapperModel->getByID( filter_input(INPUT_GET, 'wid', FILTER_SANITIZE_NUMBER_INT) );

                view('form-update', ['wapper' => $wapper]);
                return;
            }

            /** [ POST REQUEST ] */
            if (
                $this->getRequestMethod() === 'POST' &&
                array_key_exists('id', $_POST) &&
                $this->validInt($_POST['id'])
            )
            {
                if (
                    !empty($_FILES) &&
                    array_key_exists('photo', $_FILES) &&
                    array_key_exists('name', $_FILES['photo'])
                )
                {
                    if (array_key_exists('old_photo', $_POST) && !empty($_POST['old_photo']))
                    {
                        if (file_exists(CONF_UPLOADS_PATH . $_POST['old_photo']))
                        {
                            unlink(CONF_UPLOADS_PATH . $_POST['old_photo']);
                        }
                    }

                    $upload = $this->upload($_FILES);
                }

                $sanitize = [];

                foreach ($_POST as $key => $value) {

                    $sanitize [ $key ] = is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                }

                $sanitize['photo'] = !empty($upload) ? $upload: $_POST['old_photo'];
                unset($sanitize['old_photo']);

                $updated = $this->wapperModel->edit($sanitize);

                var_dump($updated);

                if ($updated) {

                    header('HTTP/1.1 302 Redirect');
                    header('Location: ' . url());
                    exit();
                }
                else {

                    view('notification', ['text' => 'Algo deu errado, tente novamente daqui a pouco', 'image' => 'undraw_server.svg']);
                    return;
                }
            }

            view ('notification', ['text' => 'Solicitação não encontrada ou mau formatada']);
        }
    }
