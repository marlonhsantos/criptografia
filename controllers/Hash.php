<?php
class Hash extends Controller
{
    /**
     * Instancia um Controller para Hash
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Carrega a view padrão com o formulário para entrada de dados para Comparação de Hashes
     *
     * @return void
     */
    public function index()
    {
        $data["title"] = "Comparação de Hashes";
        $this->loadView('inc/header',$data);
        $this->loadView('Hash/index',$data);
        $this->loadView('inc/footer');
    }

    /**
     * Recebe dados do usuário, gera hashes em formatos distintos, os compara com um hash digitado pelo usuário e exibe o resultado em JSON
     *
     * @return void
     */
    public function generate()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $user_text = $_POST["user_text"];
            $user_hash = $_POST["user_hash"];
            
            $output_data["err"] = false;
            
            $hash = new HashHandler();
            $output_data["hash_sha512"] = $hash->generateSha512($user_text);
            $output_data["hash_hmac"] = $hash->generateHmac($user_text);

            $output_data["hash_sha512_equals"] = $hash->generateSha512($user_text);
            $output_data["hash_sha512_equals"] = (strlen($user_hash))?$hash->hashEquals($output_data["hash_sha512"], $user_hash):null;
            $output_data["hash_hmac_equals"] = (strlen($user_hash))?$hash->hashEquals($output_data["hash_hmac"], $user_hash):null;
        } else {
            $output_data["err"] = true;
        }

        $data["output"] = json_encode($output_data);
        $this->loadView('json_output',$data);
    }
}