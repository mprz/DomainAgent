<?php
class Registrars {
    // store a total number of registrars
    private $_num_of_reg        = 0;
    private $_registrars        = array();
    private $_connection;

    // constructor
    public  function __construct() {
        $this->_connection=DB::getConnection();
        $this->fetch();
    }
    // returns total number of registrars in the table
    public function getTotal() {
        return $this->_num_of_reg;
    }
    // fetch all registrars from database
    public function fetch() {
        try {
            $this->_num_of_reg      = 0;
            // get all registrars
            $query=$this->_connection->prepare("SELECT reg_id, reg_name, reg_link, reg_comment, dom_reg_id, COUNT(`domains`.dom_reg_id) AS reg_num_dom
                                            FROM `registrars` LEFT JOIN `domains` ON reg_id=dom_reg_id
                                            GROUP BY reg_name
                                            ORDER BY reg_num_dom DESC");
            $query->execute();
            $result = $query->fetchAll();
            $data = '';
            foreach ($result as $row) {
                $this->_num_of_reg++;
                $data[]=$row;
            }
        }
        catch (PDOException $e)
        {
            // show error message upon PDO error
            trigger_error('Registrars: error fetching domains table: '.$e);
            return false;
        }
        $this->_registrars=$data;
        return $this->_registrars;
    }
    public function fetchAll() {
        return $this->_registrars;
    }
    public function get($id) {
        foreach ($this->_registrars as $row) {
            if ($row['reg_id']==$id)
                return $row;
        }
        return false;
    }
    // delete registrar
    public function delete($id) {
        $_result    = false;
        try {
            $query=$this->_connection->prepare("DELETE FROM `registrars`
                                    WHERE reg_id=:reg_id");
            $query->execute(array('reg_id' => $id));
            $_result = true;
        }
        catch (PDOException $e)
        {
            trigger_error('Registrars: error deleting registrar');
            $_result = false;
        }
        // let's reload just in case to reflect changes
        $this->_registrars = $this->fetch();
        return $_result;
    }
    // update database with $reg, all required info should be there
    public function update($reg) {
        $_result    = false;
        try {
            $query=$this->_connection->prepare("UPDATE `registrars`
                                    SET reg_name=:reg_name, reg_link=:reg_link, reg_comment=:reg_comment
                                    WHERE reg_id=:reg_id");
            $query->execute(array('reg_id' => $reg['reg_id'],
                'reg_name'      => $reg['reg_name'],
                'reg_link'      => $reg['reg_link'],
                'reg_comment'   => $reg['reg_comment']
            ));
            $_result = true;
        }
        catch (PDOException $e)
        {
            trigger_error('Registrars: error updating registrar');
            $_result = false;
        }
        // let's reload just in case to reflect changes
        $this->fetch();
        return $_result;
    }    
}