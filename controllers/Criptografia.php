<?php
class Criptografia extends Controller
{
    /**
     * Instancia um Controller para Criptografia
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Carrega a view padrão com formulário de dados de criptografia
     *
     * @return void
     */
    public function index()
    {
        $data["title"] = "Criptografia";
        $this->loadView('inc/header',$data);
        $this->loadView('Criptografia/index',$data);
        $this->loadView('inc/footer');
    }

    /**
     * Recebe dados do usuário e realiza a criptografia exibindo o resultado em JSON
     *
     * @return void
     */
    public function encrypt()
    {
        $output_data["err"] = true;

        if (isset($_POST) && count($_POST) > 0) {
            $user_input = $_POST["user_input"];
            //$aes256_random_key = md5(uniqid(rand(), true));
            $publicKey = Security::genRandString(32);
            $_SESSION["publicKey"] = $publicKey;

            $output_data["err"] = false;

            $crypto = new Crypto();
            $output_data["cifra_cesar"] = $crypto->encryptCaesarCipher($user_input);
            //$output_data["cifra_aes256"] = $crypto->encryptAes256($user_input, $aes256_random_key);
            $output_data["cifra_aes256"] = base64_encode($crypto->encryptAes256($user_input, $publicKey));
            //$output_data["cifra_extra"] = "zzz";
        }

        $data["output"] = json_encode($output_data);
        $this->loadView('json_output',$data);
    }

    /**
     * Recebe dados do usuário e os descriptografa exibindo o resultado em JSON
     *
     * @return void
     */
    public function decrypt()
    {
        $output_data["err"] = true;

        if (isset($_POST) && count($_POST) > 0) {
            $cifra_cesar = $_POST["cifra_cesar"];
            $cifra_aes256 = base64_decode($_POST["cifra_aes256"]);
            $publicKey = $_SESSION["publicKey"];
            //$cifra_extra = $_POST["cifra_extra"];

            $output_data["err"] = false;

            $crypto = new Crypto();
            $output_data["cifra_cesar_desc"] = $crypto->decryptCaesarCipher($cifra_cesar);
            $output_data["cifra_aes256_desc"] = $crypto->decryptAes256($cifra_aes256, $publicKey);            
            //$output_data["cifra_extra_desc"] = "ccc";
        }

        $data["output"] = json_encode($output_data);
        $this->loadView('json_output',$data);
    }
}