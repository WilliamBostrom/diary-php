<?php 

require __DIR__ . '/inc/db-connect.inc.php';
require __DIR__ . '/inc/functions.inc.php';

$perPage = 2;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
if($page < 1) {
    $page = 1;
}



$offset = ($page - 1) * $perPage;


$stmtCount = $pdo->prepare('SELECT COUNT(*) as `count` FROM `entries`');
$stmtCount->execute();
$count = $stmtCount->fetch(PDO::FETCH_ASSOC)['count'];


$numPages = ceil($count / $perPage);
$stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY `date` DESC, `id` DESC LIMIT :perPage OFFSET :offset');
$stmt->bindValue(':perPage', (int) $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include __DIR__ . '/views/header.view.php'; ?>
<h1 class="main-heading">results</h1>

<?php foreach ($results as $entry) { ?>
<div class="card">
    <div class="card__image-container">
        <img class="card__image" src="./images/pexels-canva-studio-3153199.jpg" alt="" />
    </div>
    <div class="card__desc-container">
        <div class="card__desc-time"><?php echo $entry['date']; ?></div>
        <h2 class="card__heading"><?php echo $entry['title']; ?></h2>
        <p class="card__paragraph">
            <?php echo nl2br(e($entry['message'])); ?>
        </p>
    </div>
</div>
<?php } ?>

<?php if($numPages > 1): ?>
    <ul class="pagination">
        <?php if($page > 1): ?>
        <li class="pagination__li">
            <a class="pagination__link" href="index.php?<?php echo http_build_query(['page' => $page - 1]); ?>">⏴</a>
        </li>
        <?php endif; ?>
        <?php for($x = 1; $x <= $numPages; $x++): ?>
        <li class="pagination__li">
            <a class="pagination__link <?php echo $page === $x ? 'pagination__link--active' : ''; ?>" href="index.php?<?php echo http_build_query(['page' => $x]); ?>"><?php echo $x; ?></a>
        </li>
        <?php endfor; ?>
        <?php if($page >= $numPages): ?>
        <li class="pagination__li">
            <a class="pagination__link" href="index.php?<?php echo http_build_query(['page' => $page + 1]); ?>">⏵</a>
        </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php include __DIR__ . '/views/footer.view.php'; ?>