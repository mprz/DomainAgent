<?php
class Domains {
    protected $_total             = 0;    // store total number of domains
    protected $_good              = 0;    // store number of domains in good standing
    protected $_expiring          = 0;    // store number of expiring domains
    protected $_expired           = 0;    // store number of expired domains
    protected $_domains           = array();
    protected $_connection;

    const DOMAIN_OK             = 0;
    const DOMAIN_EXPIRING       = 1;
    const DOMAIN_EXPIRED        = 2;
    
    public function __construct() {
        $this->_connection=DB::getConnection();
        $this->_domains=$this->fetchAll();
    }
    // returns a number of domains
    public function numTotal() {
        return $this->_total;
    }
    // returns number of good domains
    public function numGood() {
        return $this->_good;
    }
    // returns number of expiring domains
    public function numExpiring() {
        return $this->_expiring;
    }
    // returns number of expired domains
    public function numExpired() {
        return $this->_expired;
    }
    // validates domain data
    public function validate($domain) {
        $result    =   true;
        // perform check here
        return $result;
    }
    // get a domain details for domain with given id
    public function get($id) {
        // basically we are going through the whole list and if we find a match we return the content
        foreach($this->_domains as $domain) {
            if ($domain['dom_id']==$id)
                $result=$domain;
        }
        // in case we won't find the match let's indicate it
        if (!isset($result))
            $result=false;
        return $result;
    }
    // delete domain
    public function delete($id) {
        try {
            $query=$this->_connection->prepare("DELETE FROM `domains`
                                    WHERE dom_id=:dom_id");
            $query->execute(array('dom_id'          => $id));
            $result = true;
        }
        catch (PDOException $e)
        {
            trigger_error('Domains: error deleting domain');
            $result = false;
        }
        // let's reload just in case to reflect changes
        $this->_domains = $this->fetchAll();
        return $result;
    }
    // update database with $domain, all required info should be there STUB
    public function update($domain) {
        try {
            $query=$this->_connection->prepare("UPDATE `domains`
                                    SET dom_name=:dom_name, dom_reg_id=:dom_reg_id, dom_reg_date=:dom_reg_date,
                                        dom_exp_date=:dom_exp_date, dom_comment=:dom_comment, dom_status=0
                                    WHERE dom_id=:dom_id");
            $query->execute(array('dom_id'          => $domain['dom_id'],
                                    'dom_name'      => $domain['dom_name'],
                                    'dom_reg_id'    => $domain['dom_reg_id'],
                                    'dom_reg_date'  => $domain['dom_reg_date'],
                                    'dom_exp_date'  => $domain['dom_exp_date'],
                                    'dom_comment'   => $domain['dom_comment']
            ));
            $result = true;
        }
        catch (PDOException $e)
        {
            trigger_error('Domains: error updating domain');
            $result = false;
        }
        // let's reload just in case to reflect changes
        $this->_domains = $this->fetchAll();
        return $result;
    }
    // insert a domain into database
    public function insert($domain) {
        // check if this is a valid domain
        if ($this->validate($domain)) {
            // perform insert here
            try {
                $query=$this->_connection->prepare("INSERT INTO `domains` (dom_name, dom_reg_id, dom_reg_date, dom_exp_date, dom_comment)
                                        VALUES (:dom_name, :dom_reg_id, :dom_reg_date,
                                            :dom_exp_date, :dom_comment)");
                $query->execute(array(  'dom_name'      => $domain['dom_name'],
                                        'dom_reg_id'    => (int)$domain['dom_reg_id'],
                                        'dom_reg_date'  => $domain['dom_reg_date'],
                                        'dom_exp_date'  => $domain['dom_exp_date'],
                                        'dom_comment'   => $domain['dom_comment'],
                ));
                $result = true;
            }
            catch (PDOException $e)
            {
                trigger_error('Domains: error inserting domain'+$e);
                $result = false;
            }            
        } else
        {
            trigger_error('Domains: trying to insert invalid domain data.');
            $result=false;
        }
        // let's reload just in case to reflect changes
        $this->_domains = $this->fetchAll();
        return $result;
    }
    // fetch all domains from database
    public function fetch() {
        try {
            $this->_total=0;
            $this->_expired=0;
            $this->_expiring=0;
            $this->_good=0;
            // open connection and create query
            $today = date("Y-m-d");
            // get all domains and calculate how many days left based on current date and exp_date
            $query=$this->_connection->prepare("SELECT dom_id, dom_name, dom_reg_id, dom_reg_date, dom_exp_date,
                                            dom_comment, dom_status, TIMESTAMPDIFF(DAY, :today,
                                            domains.dom_exp_date) as dom_days_left
                                            FROM `domains`, `registrars`
                                            WHERE dom_reg_id=reg_id
                                            ORDER BY dom_days_left, dom_name");
            $query->execute(array('today' => $today));
            $result = $query->fetchAll();
            $data = '';
            foreach ($result as $row) {
                $this->_total++;
                if ($row['dom_days_left']>30) {
                    $row['Status']=Domains::DOMAIN_OK;
                    $this->_good++;
                }
                elseif ($row['dom_days_left']>1) {
                    $row['Status']=Domains::DOMAIN_EXPIRING;
                    $this->_expiring++;
                }
                else {
                    $row['Status']=Domains::DOMAIN_EXPIRED;
                    $this->_expired++;
                }
                $data[]=$row;
            }
        }
        catch (PDOException $e)
        {
            // show error message upon PDO error
            trigger_error('Domains: error fetching domains table: '.$e);
            return false;
        }
        if (!empty($data)){
            $this->_domains=$data;
            $result=$data;
        } else
            $result=false;
        return $result;
    }
    // fetch an array of good domains
    public function fetchAll() {
        return $this->fetch();
    }
    // fetch an array of good domains
    public function fetchGood() {
        // browse all domains
        foreach ($this->_domains as $row) {
            if ($row['dom_days_left']>30)
                // add domains with more than 30 days left to result
                $data[]=$row;
        }
        if (!empty($data))
            return $data;
        else
            return false;
    }
    // fetch an array of good domains
    public function fetchExpiring() {
        // browse all domains
        foreach ($this->_domains as $row) {
            // add domains between 1 and 30 days to result
            if ($row['dom_days_left']>1 && $row['dom_days_left']<=30)
                $data[]=$row;
        }
        if (!empty($data))
            return $data;
        else
            return false;
    }
    // fetch an array of good domains
    public function fetchExpired() {
        // browse all domains
        foreach ($this->_domains as $row) {
            // add ones below one day to the result
            if ($row['dom_days_left']<=1)
                $data[]=$row;
        }
        if (!empty($data))
            return $data;
        else
            return false;
    }
}