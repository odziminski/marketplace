<?php
class DBconnect
{
    private $host;
    private $username;
    private $password;
    private $dsn;

    protected function getConnection()
    {
        $this->dsn = "mysql:host=127.0.0.1;dbname=advertisements";
        $this->password = "";
        $this->username = 'root';

        try
        {
            $dbh = new PDO($this->dsn, $this->username, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $dbh;
        }
        catch(PDOException $e)
        {
            echo 'Can not connect to the database : ' . $e->getMessage();
        }
    }
}

