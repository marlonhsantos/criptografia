<?php
class Ssh
{  
    private $hostname;
    private $port;
    private $username;
    private $password;
    private $connection;
    private $is_authenticathed;

    /**
     * Instancia um objeto SSH e realiza uma conexão e autenticação
     *
     * @param string $hostname
     * @param string $port
     * @param string $username
     * @param string $password
     * @return void
     */
    public function __construct($hostname=null, $port='22', $username=null, $password=null)
    {
        $this->is_authenticathed = false;
        $this->connect($hostname, $port);
        $this->auth($username, $password);
    }

    /**
     * Realiza uma conexão SSH
     *
     * @param string $hostname
     * @param string $port
     * @return void
     */
    public function connect($hostname=null, $port=null)
    {
        $connection = ssh2_connect($hostname, $port);

        if (is_resource($connection)) {
            $this->connection = $connection;
            $this->hostname = $hostname;
            $this->port = $port;
        }
    }

    /**
     * Realiza uma conexão SSH e autenticação com os dados já gravados nas propriedades
     *
     * @return void
     */
    public function reconnect()
    {
        $this->connect($this->hostname, $this->port);
        $this->auth($this->username, $this->password);
    }

    /**
     * Realiza a autenticação em um dispositivo conectado via Ssh
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public function auth($username=null, $password=null)
    {
        $this->is_authenticathed = ssh2_auth_password($this->connection, $username, $password);
        if ($this->is_authenticathed) {
            $this->username = $username;
            $this->password = $password;
        }

    }

    /**
     * Verifica se a conexão SSH é válida
     *
     * @return boolean
     */
    public function isConnected()
    {
        if (is_resource($this->connection)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica se há autenticação com o dispositivo SSH
     *
     * @return boolean
     */
    public function isAuthenticathed()
    {
        return $this->is_authenticathed;
    }

    /**
     * Envia um comando para o dispositivo SSH conectado e recebe uma resposta
     *
     * @param string $command
     * @return string
     */
    public function exec($command = null)
    {
        if ($this->isAuthenticathed()) {
            $stream = ssh2_exec($this->connection, $command);
            stream_set_blocking($stream, true);
            $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
            return stream_get_contents($stream_out);
        } else {
            return false;
        }
    }

    /**
     * Desconecta um dispositivo SSH
     *
     * @return void
     */
    public function disconnect()
    {
        if ($this->isConnected()) {
            if (ssh2_disconnect($this->connection)) {
                $this->connection = null;
            }
        }
    }
}