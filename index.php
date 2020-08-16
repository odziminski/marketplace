<?php require 'includes/header.html'; ?>

<h2 class="text-margin"><b> Welcome to the marketplace </b></h2>

<h6>
    <a class href="advertisements/category.php"> Click here to add your advertisement </a>
</h6>
<br>

<?php
require_once 'db/SelectAd.php';
$b = new selectAdvertisement;
?>
<p> <u> Newest ads </u> </p>
<?=$b->DisplayAds("SELECT id_ad,content,title,price,image_name,category FROM ads ORDER BY date_added DESC LIMIT 8;");

?>
</div>
</div>
</div>
<?php require_once 'includes/footer.html'; ?>
</body>
