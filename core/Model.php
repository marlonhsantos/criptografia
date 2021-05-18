<?php
class Model
{   
    protected $db;

    /**
     * Instancia uma nova Model
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Instancia uma conexão com o banco de dados e passa para a Model
     *
     * @return void
     */
    public function loadDatabase(){
        $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    }   
}