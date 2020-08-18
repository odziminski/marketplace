<?php require 'includes/header.html'; ?>

<h2 class="text-margin"><b> Welcome to the marketplace </b></h2>


<?php
require_once 'db/SelectAd.php';
$b = new selectAdvertisement;
?>
<h4>  Latest ads  </h4>
<hr>
<?=$b->DisplayAds("
SELECT id_ad,content,title,price,image_name,category FROM ads ORDER BY date_added DESC LIMIT 8;
");

?>

<?php require_once 'includes/footer.html'; ?>
</body>
