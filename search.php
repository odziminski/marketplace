<?php
ini_set('display_errors', 0);
include_once 'includes/header.html';
require_once 'db/SelectAd.php';
require_once 'db/Pagination.php';

$search = $_POST['search'];

if (isset($_POST['search_button']))
{
    if (!empty($search))
    {
        $search = str_replace(' ', '%', $search);
    }
    else
    {
        header('Location:browse.php');
    }
}

global $total_pages;
global $pageno;
$c = new Pagination;
$c->setDefaults();

$c->countAds("
SELECT COUNT(*) as count FROM ads WHERE title LIKE '%{$search}%' OR content LIKE '%{$search}%';
");

$c->PagenoOffset();


$c->SelectLimitAd("
SELECT * FROM ads WHERE title LIKE '%{$search}%' OR content LIKE '%{$search}%';
");


if ($total_pages > 1)
{
    echo "</br><div class='pages d-inline p-2'>Pages:";
    for ($pageno = 1;$pageno <= $total_pages;$pageno++)
    {
?>

<a href="marketplace/search.php?pageno=<?=$pageno?>"><?=$pageno?></a>
<?php
    }
}
session_destroy();

?>

</div>

