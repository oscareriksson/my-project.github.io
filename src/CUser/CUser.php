<?php

class CUser {
    private $sql = "";
    private $params = array();
    private $authenticated = false;
    private $result = null;

    public function __construct()
    {
        if (isset($_SESSION['user'])) {
                $this->authenticated = true;
            }

    }

    public function Login($user, $password, $connectInfo)
    {
            $this->db = new CDatabase($connectInfo);

            $this->sql = "SELECT acronym, name FROM user WHERE acronym = ? AND password = md5(concat(?, salt))";
            $this->params = array($user, $password);
            $this->res = $this->db->ExecuteSelectQueryAndFetchAll($this->sql, $this->params);
            if(isset($this->res[0])) {
                $_SESSION['user'] = $this->res[0];
                $this->result = "Inloggning lyckades";
                $this->authenticated = true;
        }
        else {
            $this->result = "Du har angivit fel användarnamn eller lösenord.";
        }
    }


    public function Logout($logout)
    {
        if($logout) {
            unset($_SESSION['user']);
            header('Location: login.php');
        }
    }

    public function IsAuthenticated()
    {
        return $this->authenticated;
    }

    public function getName()
    {
        return $_SESSION['user']->name;
    }

    public function getAcronym()
    {
        return $_SESSION['user']->acronym;
    }

    public function getResult()
    {
        return $this->result;
    }
}
