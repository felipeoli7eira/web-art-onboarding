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
                        'image' => 'img/undraw_server.svg'
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

                if ( !empty($requestFiles) && array_key_exists('photo', $requestFiles) && mb_strlen($requestFiles['photo']['name']) ) {
                    $upload = $this->upload($requestFiles);
                }

                /** xss */
                $sanitizeFields = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

                $sanitizeFields['photo'] = ! empty($upload) ? $upload : null;

                $created = $this->wapperModel->insert($sanitizeFields);

                if ($created) {

                    $this->setResponseToFront('Wapper cadastrado');
                    redirect(url());
                    exit();
                }
                else {

                    $this->setResponseToFront('Algo deu errado, tente novamente daqui a pouco');
                    redirect(url());
                    exit();
                }
            }
            else {

                view('notification', ['text' => 'Solicitação não encontrada', 'image' => 'img/undraw_server.svg']);
            }
        }

        /**
         * Deleta um wapper pelo id
         * @method destroy()
         * @return void
        */
        public function destroy(): void
        {
            if ($this->getRequestMethod() === 'GET' && array_key_exists( /** wapper id */ 'wid', $_GET)) {

                if ($this->validInt($_GET['wid'])) {

                    $wid = filter_input(INPUT_GET, 'wid', FILTER_SANITIZE_NUMBER_INT);

                    $wapper = $this->wapperModel->getByID($wid);

                    if (!is_null($wapper)) { /** se existe um wapper com ID passado */

                        if (!is_null($wapper->photo) && file_exists(CONF_UPLOADS_PATH . $wapper->photo) && is_file(CONF_UPLOADS_PATH . $wapper->photo) ) {
                            unlink(CONF_UPLOADS_PATH . $wapper->photo);
                        }

                        $deleted = $this->wapperModel->destroy($wid);

                        if ($deleted) {

                            $this->setResponseToFront('Wapper removido');
                            redirect(url());
                            exit();
                        }
                        else {

                            $this->setResponseToFront('Erro ao tentar remover o wapper');
                            redirect(url());
                            exit();
                        }
                    }

                    $this->setResponseToFront('Waper não encontrado');
                    redirect(url());
                    exit();
                }
                else {

                    $this->setResponseToFront('Erro na identificação do wapper');
                    redirect(url());
                    exit();
                }
            }
            else {

                view ('notification', ['text' => 'Solicitação não encontrada ou mau formatada']);
            }
        }

        /**
         * Caso a requisição seja GET, exibe o formulário de edição
         * Caso a requisição seja POST, executa o update
         * @method edit()
         * @return void
        */
        public function edit(): void
        {
            /** [ GET REQUEST ] */
            if ( $this->getRequestMethod() === 'GET' && array_key_exists( /** wapper id */ 'wid', $_GET) && $this->validInt($_GET['wid']) ) {

                $wapper = $this->wapperModel->getByID( filter_input(INPUT_GET, 'wid', FILTER_SANITIZE_NUMBER_INT) );

                view('form-update', ['wapper' => $wapper]);
                return;
            }

            /** [ POST REQUEST ] */
            if ($this->getRequestMethod() === 'POST' && array_key_exists('id', $_POST) && $this->validInt($_POST['id']) ) {

                /** Entra nesse if() se o usuário enviou uma foto e é a foto que o back-end está esperando receber */
                if ( !empty($_FILES) && array_key_exists('photo', $_FILES) && mb_strlen($_FILES['photo']['name']) ) {

                    /**
                     * Se foi enviada uma foto, então a foto antiga deve ser removida do disco para a entrada da nova foto.
                     * 
                     * Então se o nome da foto antiga foi recebido:
                     * */
                    if (array_key_exists('old_photo', $_POST) && mb_strlen($_POST['old_photo'])) {

                        /** Verifica se a foto está na pasta. Se sim deleta de lá */
                        if (file_exists(CONF_UPLOADS_PATH . $_POST['old_photo'])) {

                            unlink(CONF_UPLOADS_PATH . $_POST['old_photo']);
                        }
                    }

                    /** Depois da deleção da antiga foto, upar a nova */
                    $upload = $this->upload($_FILES);
                }

                $sanitizeFields = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

                $sanitizeFields['photo'] = ! empty($upload) ? $upload : $sanitizeFields['old_photo'];

                unset($sanitizeFields['old_photo']);

                $updated = $this->wapperModel->edit($sanitizeFields);

                if ($updated >= 0) {

                    $this->setResponseToFront('Atualização feita');
                    redirect(url());
                    exit();
                }
                else {

                    $this->setResponseToFront('Erro na atualização');
                    redirect(url());
                    exit();
                }
            }

            view ('notification', ['text' => 'Solicitação não encontrada ou mau formatada']);
        }
    }
