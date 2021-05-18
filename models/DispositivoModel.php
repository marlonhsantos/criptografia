<?php
class DispositivoModel extends Model
{
    /**
     * Instancia um novo Modelo para Dispositivo e carrega conexão com o banco de dados
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadDatabase();
    }

    /**
     * Busca todos os dispositivos no banco e retorna
     *
     * @return array
     */
    public function get()
    {
        $rs = $this->db->query('SELECT * FROM dispositivo');
        $rows = array();
        if ($rs->rowCount() > 0) {
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    /**
     * Recebe um ID de Dispositivo e retorna seus dados
     *
     * @param integer $id
     * @return array
     */
    public function getById($id)
    {
        $rs = $this->db->query("SELECT * FROM dispositivo WHERE id = ".$id);
        $rows = array();
        if ($rs->rowCount() > 0) {
            $row = $rs->fetch(PDO::FETCH_OBJ);
            return $row;
        } else {
            return false;
        }

    }

    /**
     * Insere um novo Dispositivo no banco de dados
     *
     * @param array $input_data
     * @return void
     */
    public function add($input_data)
    {
        $stmt = $this->db->prepare("INSERT INTO dispositivo(hostname, ip, tipo, nome_fabricante) VALUES(?, ?, ?, ?)");
        $stmt->bindParam(1, $input_data["hostname"]);
        $stmt->bindParam(2, $input_data["ip"]);
        $stmt->bindParam(3, $input_data["tipo"]);
        $stmt->bindParam(4, $input_data["nome_fabricante"]);
        $stmt->execute();

        $lastInsertId = $this->db->lastInsertId();
        
        if ($lastInsertId > 0) {
            return $lastInsertId;
        } else {
            return false;
        }
    }

    /**
     * Recebe um ID de Dispositivo e altera o registro
     *
     * @param integer $id
     * @param array $input_data
     * @return void
     */
    public function update($id, $input_data)
    {
        $stmt = $this->db->prepare("UPDATE dispositivo SET hostname = :hostname, ip = :ip, tipo = :tipo, nome_fabricante = :nome_fabricante WHERE id = :id");
        $stmt->execute(array(
            ':id' => $id,
            ':hostname' => $input_data["hostname"],
            ':ip' => $input_data["ip"],
            ':tipo' => $input_data["tipo"],
            ':nome_fabricante' => $input_data["nome_fabricante"]
        ));

        $affected_rows = $stmt->rowCount();
        
        if ($affected_rows > 0) {
            return $affected_rows;
        } else {
            return false;
        }
    }

    /**
     * Recebe um ID de Dispositivo e apaga o registro
     *
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM dispositivo WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $affected_rows = $stmt->rowCount();
        
        if ($affected_rows > 0) {
            return $affected_rows;
        } else {
            return false;
        }
    }
}