<?php
class Registrars {
    // store a total number of registrars
    private $num_of_reg        = 0;
    private $registrars        = array();
    private $connection;

    // constructor
    public  function __construct() {
        $this->connection=DB::getConnection();
        $this->fetch();
    }
    // returns total number of registrars in the table
    public function getTotal() {
        return $this->num_of_reg;
    }
    public function insert($registrar) {
        try {
            $query=$this->connection->prepare("INSERT INTO `registrars` (reg_name, reg_link, reg_comment)
                                    VALUES (:reg_name, :reg_link, :reg_comment)");
            $query->execute(array(  'reg_name'      => $registrar['reg_name'],
                                    'reg_link'      => $registrar['reg_link'],
                                    'reg_comment'   => $registrar['reg_comment'],
            ));
            $result = true;
        }
        catch (PDOException $e)
        {
            trigger_error('Registrars: error inserting registrar'+$e);
            $result = false;
        }
        return $result;
    }
    // fetch all registrars from database
    public function fetch() {
        try {
            $this->num_of_reg      = 0;
            // get all registrars
            $query=$this->connection->prepare("SELECT reg_id, reg_name, reg_link, reg_comment, dom_reg_id, COUNT(`domains`.dom_reg_id) AS reg_num_dom
                                            FROM `registrars` LEFT JOIN `domains` ON reg_id=dom_reg_id
                                            GROUP BY reg_name
                                            ORDER BY reg_num_dom DESC");
            $query->execute();
            $result = $query->fetchAll();
            $data = '';
            foreach ($result as $row) {
                $this->num_of_reg++;
                $data[]=$row;
            }
        }
        catch (PDOException $e)
        {
            // show error message upon PDO error
            trigger_error('Registrars: error fetching domains table: '.$e);
            return false;
        }
        $this->registrars=$data;
        return $this->registrars;
    }
    public function fetchAll() {
        return $this->registrars;
    }
    public function get($id) {
        foreach ($this->registrars as $row) {
            if ($row['reg_id']==$id)
                return $row;
        }
        return false;
    }
    // delete registrar
    public function delete($id) {
        $result    = false;
        try {
            $query=$this->connection->prepare("DELETE FROM `registrars`
                                    WHERE reg_id=:reg_id");
            $query->execute(array('reg_id' => $id));
            $result = true;
        }
        catch (PDOException $e)
        {
            trigger_error('Registrars: error deleting registrar');
            $result = false;
        }
        // let's reload just in case to reflect changes
        $this->registrars = $this->fetch();
        return $result;
    }
    // update database with $reg, all required info should be there
    public function update($reg) {
        $result    = false;
        try {
            $query=$this->connection->prepare("UPDATE `registrars`
                                    SET reg_name=:reg_name, reg_link=:reg_link, reg_comment=:reg_comment
                                    WHERE reg_id=:reg_id");
            $query->execute(array('reg_id' => $reg['reg_id'],
                'reg_name'      => $reg['reg_name'],
                'reg_link'      => $reg['reg_link'],
                'reg_comment'   => $reg['reg_comment']
            ));
            $result = true;
        }
        catch (PDOException $e)
        {
            trigger_error('Registrars: error updating registrar');
            $result = false;
        }
        // let's reload just in case to reflect changes
        $this->fetch();
        return $result;
    }    
}