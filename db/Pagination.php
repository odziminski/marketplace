<?php
require_once 'connect.php';
require_once 'SelectAd.php';

class Pagination extends selectAdvertisement
{
    public $limitPerPage;
    public $offset;

    public function __construct($offset = 0, $limitPerPage = 10)
    {
        $this->limitPerPage = $_GET['limit'];
        $this->offset = $offset;
    }

    public function setDefaults()
    {
        if (!isset($this->limitPerPage))
        {
            $this->limitPerPage = 10;
            $this->offset = 0;
        }
    }

    public function countAds($countQuery)
    {
        $starttime = microtime(true);

        global $total_pages;
        $stmt = $this->getConnection()
            ->prepare($countQuery);
        $stmt->execute();
        $no_of_rows = $stmt->fetchColumn();

        $endtime = microtime(true);
        $duration = round($endtime - $starttime,3);

        if ($no_of_rows > 0)
        {
            echo "<p>Found <b> $no_of_rows </b> ads in $duration seconds." . "<br></p>";
            $total_pages = ceil($no_of_rows / $this->limitPerPage);
            return $total_pages;
        }
        else
        {
            exit("<h2> Nothing to show yet. </h2>" .
            "<a href='marketplace/index.php'> 
            Go back to main page.");
        }
    }

    public function PagenoOffset()
    {
        global $pageno;
        if (!isset($_GET['pageno']))
        {
            $pageno = 1;
        }
        else
        {
            $pageno = $_GET['pageno'];
        }

        $this->offset = ($pageno - 1) * $this->limitPerPage;
    }

    public function SelectLimitAd($query)
    {
        $query .= "LIMIT $this->offset,$this->limitPerPage";
        $this->DisplayAds($query);
    }

}