<?php
session_start();
require 'connect.php';

class createAdvertisement extends DBconnect
{
    private $ad;
    public $errors;
    private $email;
    private $title;
    public $category;
    private $price;
    private $sell_buy;

    public function __construct($ad = "", $errors = [], $email = "", $title = "", $category = "", $price = "", $sell_buy = 0, $file = "")
    {
        $this->ad = $_POST['ad'];
        $this->errors = $errors;
        $this->email = $_POST['email'];
        $this->title = $_POST['title'];
        $this->file = $file;
        $this->category = $_SESSION['category'];
        $this->price = $_POST['price'];
        @$this->sell_buy = $_POST['sell_buy'];
    }

    public function SetCategory($category = "none")
    {
        return $this->category;
    }
    public function CheckImage()
    {
        if (!empty($_FILES["image"]["name"]))
        {
            $image = str_replace(' ', '_', $_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], "../img/submitted/" . $image);
            $this->file = $image;
            return $this->file;
        }
    }

    public function CheckTitle()
    {
        if (empty($this->title))
        {
            array_push($this->errors, "Title must be set!");
        }
        if ((strlen($this->title) > 55))
        {
            array_push($this->errors, "Title is too long!");
        }
    }

    public function CheckRadio()
    {
        if (!isset($this->sell_buy))
        {
            if (empty($this->sell_buy))
            {
                $this->sell_buy = "null";
            }
        }
        else
        {
            return $this->sell_buy;
        }
    }

    public function CheckAd()
    {
        if (empty($this->ad))
        {
            array_push($this->errors, "You must fill the ad!");
        }

        if ((strlen($this->ad) > 1024) || (strlen($this->ad) < 6))
        {
            array_push($this->errors, "Invalid ad!");
        }
    }

    public function CheckPrice()
    {
        if (((isset($this->price)) && (is_numeric($this->price) && $this->price>0)))
        {
                return $this->price;
        }
        else
        {
            array_push($this->errors, "Invalid price!");
        }
    }

    public function CheckEmail()
    {
        if (empty($this->email))
        {
            if (!strpos($this->email, '@'))
            {
                array_push($this->errors, "Invalid email!");
            }
        }
    }

    public function CheckErrors()
    {
        if (count($this->errors) > 0)
        {
            echo "<h1>";
            foreach ($this->errors as $error)
            {
                echo $error . "<br>";
            }
            exit;
            echo "</h1>";
        }
    }

    public function InsertAd()
    {
        if (isset($_POST['submit']))
        {
            if (empty($this->errors))
            {
                $query = "INSERT INTO `ads`(id_ad,category,title,sell_buy, content,image_name,price, email) VALUES ('',?,?,?,?,?,?,?); ";
                $stmt = $this->getConnection()
                    ->prepare($query);

                $stmt->bindValue(1, $this->category, PDO::PARAM_STR);
                $stmt->bindValue(2, $this->title, PDO::PARAM_STR);
                $stmt->bindValue(3, $this->sell_buy, PDO::PARAM_STR);
                $stmt->bindValue(4, $this->ad, PDO::PARAM_STR);
                $stmt->bindValue(5, $this->file, PDO::PARAM_STR);
                $stmt->bindValue(6, $this->price, PDO::PARAM_STR);
                $stmt->bindValue(7, $this->email, PDO::PARAM_STR);

                $stmt->execute();
                if ($stmt)
                {
                    echo '<p class="text-success"> Advertisement added successfully. </br>';
                    echo "You will be redirected to main page.</p>";
                    header("refresh:2; url=../index.php");

                }
                else
                {
                    exit("Error while inserting an advertisement.");
                }

            }
        
        else
        {
            echo "Error occured";
        }
    }
    }
}
$a = new createAdvertisement();
$a->SetCategory($_SESSION['category']);
$a->CheckImage();
$a->CheckTitle();
$a->CheckRadio();
$a->CheckAd();
$a->CheckPrice();
$a->CheckEmail();
$a->CheckErrors();
$a->InsertAd();