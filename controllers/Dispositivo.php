<?php
class Dispositivo extends Controller 
{
    /**
     * Instancia um Controller para Dispositivo e carrega uma Model para conexão com banco
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('DispositivoModel');
    }

    /**
     * Carrega a view padrão com a listagem de dispositivos
     *
     * @return void
     */
    public function index()
    {
        $data["title"] = "Lista de dispositivos";
        $data["rows"] = $this->DispositivoModel->get();
        $this->loadView('inc/header',$data);
        $this->loadView('Dispositivo/index',$data);
        $this->loadView('inc/footer');
    }

    /**
     * Recebe um id de dispositivo e carrega os dados em formulário
     *
     * @return void
     */
    public function get()
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            $data["title"] = "Dispositivo não nao_encontrado";
            $this->loadView('inc/header',$data);
            $this->loadView('Dispositivo/nao_encontrado');
            $this->loadView('inc/footer');
        } else {
            $id = $_GET["id"];
            $data["title"] = "Editar dispositivo";
            $row = $this->DispositivoModel->getById($id);
            if (is_object($row)) {
                
                $data["id"] = $id;
                $data["hostname"] = $row->hostname;
                $data["ip"] = $row->ip;
                $data["tipo"] = $row->tipo;
                $data["nome_fabricante"] = $row->nome_fabricante;

                $this->loadView('inc/header',$data);
                $this->loadView('Dispositivo/form',$data);
                $this->loadView('inc/footer');
            } else {
                $data["title"] = "Dispositivo não nao_encontrado";
                $this->loadView('inc/header',$data);
                $this->loadView('Dispositivo/nao_encontrado');
                $this->loadView('inc/footer');
            }
        }
    }

    /**
     * Recebe dados do usuário e exibe um formulário para criação de novo Dispositivo
     *
     * @return void
     */
    public function create()
    {

        $data["title"] = "Novo dispositivo";
        $data["id"] = '';
        $data["hostname"] = '';
        $data["ip"] = '';
        $data["tipo"] = '';
        $data["nome_fabricante"] = '';
        $this->loadView('inc/header',$data);
        $this->loadView('Dispositivo/form',$data);
        $this->loadView('inc/footer');
    }

    /**
     * Recebe dados do usuário e adiciona um novo dispositivo exibindo o resultado em JSON
     *
     * @return void
     */
    public function add()
    {
        $output_data = array();
        if (isset($_POST) && count($_POST) > 0) {
            $input_data = $_POST;
            $id = $this->DispositivoModel->add($input_data);
            if (is_numeric($id)) {
                $output_data["id"] = $id;
            } else {
                $output_data["err"] = true;
            }
        }
        $data["output"] = json_encode($output_data);
        
        $this->loadView('json_output',$data);
    }

    /**
     * Recebe dados do usuário e um ID de Dispositivo para alterar os dados e exibindo o resultado em JSON
     *
     * @return void
     */
    public function update()
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            $output_data["err"] = true;
        } else {
            $id = $_GET["id"];
            $output_data = array();

            if (isset($_POST) && count($_POST) > 0) {
                $input_data = $_POST;
                $affected_rows = $this->DispositivoModel->update($id, $input_data);
                if (is_numeric($affected_rows)) {
                    $output_data["affected_rows"] = $affected_rows;
                } else {
                    $output_data["err"] = true;
                }

            }
        }

        $data["output"] = json_encode($output_data);
        
        $this->loadView('json_output',$data);
    }

    /**
     * Recebe um ID de Dispositivo e o apaga exibindo o resultado em JSON
     *
     * @return void
     */
    public function delete()
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            $output_data["err"] = true;
        } else {
            $id = $_GET["id"];
            $output_data = array();

            $affected_rows = $this->DispositivoModel->delete($id);
            if (is_numeric($affected_rows)) {
                $output_data["affected_rows"] = $affected_rows;
            } else {
                $output_data["err"] = true;
            }
        }

        $data["output"] = json_encode($output_data);
        
        $this->loadView('json_output',$data);
    }

    /**
     * Exibe o formulário para entrada de dados de conexão com um Dispositivo
     *
     * @return void
     */
    public function formConnect()
    {
        $data["title"] = "Conectar dispositivo";
        $data["rows"] = $this->DispositivoModel->get();
        $this->loadView('inc/header',$data);
        $this->loadView('Dispositivo/form_connect',$data);
        $this->loadView('inc/footer');
    }

    /**
     * Recebe dados do usuário e realiza a conexão com um Dispositivo exibindo o resultado em JSON
     *
     * @return void
     */
    public function sshConnect()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $connect_data = $_POST;
            $row = $this->DispositivoModel->getById($connect_data["id"]);
            $connect_data["hostname"] = $row->hostname;
            $connect_data["port"] = 22;

            $ssh = new Ssh($connect_data["hostname"], $connect_data["port"], $connect_data["ssh_username"], $connect_data["ssh_password"]);
            
            $connection_name = $connect_data["hostname"]."_".time();
            $_SESSION["ssh_objects"][$connection_name] = $ssh;
            
            $output_data["connected"] = $ssh->isAuthenticathed();
            $output_data["ssh_connection_name"] = $connection_name;
        } else {
            $output_data["connected"] = false;
        }

        $data["output"] = json_encode($output_data);

        $this->loadView('json_output',$data);
    }

    /**
     * Recebe um comando do usuário e o executa no Dispositivo conectado exibindo os dados de saída em formato puro
     *
     * @return void
     */
    public function sshCommand()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $connection_name = $_POST["ssh_connection_name"];
            
            if (isset($_SESSION["ssh_objects"][$connection_name])) {
                $ssh = $_SESSION["ssh_objects"][$connection_name];
                $ssh->reconnect();

                $ssh_command = $_POST["ssh_command"];
             
                if ($ssh->isAuthenticathed()) {
                    $data['output'] = $ssh->exec($ssh_command);
                } else {
                    $data["output"] = '';
                }
            } else {
                $data["output"] = '';
            }

        } else {
            $data["output"] = '';
        }

        $data["output"] = $this->loadView('raw_output',$data);
    } 
}