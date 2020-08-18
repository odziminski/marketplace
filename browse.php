<?php
session_start();
ini_set('display_errors', 0);
require_once 'includes/header.html';
include 'includes/form_limit.html';
require_once 'db/Pagination.php';
include_once 'includes/category_filter.html';

global $total_pages;
global $pageno;

$filter = $_SESSION['filter_category']??null;
$c = new Pagination;

$sqlCount = "
SELECT COUNT(*) as count FROM ads
";

$sql = "
SELECT * FROM ads
";

$where = " ";
if (isset($_POST['filter_category_button']) || $filter)
{
    $category = $_POST['filter_category']??$filter;
    $_SESSION['filter_category'] = $category;
    if ($category !== "All")
    {
        $where .= " WHERE category LIKE '" . $category . "'";
    }

}

$sqlCount .= $where;
$sql .= $where;

$c->setDefaults();
$c->countAds($sqlCount);
$c->PagenoOffset();
$c->SelectLimitAd($sql);

if ($total_pages > 1)
{
    echo "</br><div class='pages d-inline p-2'>Pages:";
    for ($pageno = 1;$pageno <= $total_pages;$pageno++)
    {
?>

<a href="marketplace/browse.php?pageno=<?=$pageno?>"><?=$pageno?></a>
<?php
    }
}
session_destroy();
?>
</div>
