<?php
	$total = count($paginator);
    $limit = $paginator->getQuery()->getMaxResults();
    $offset = $paginator->getQuery()->getFirstResult();

    $pages = (int)ceil($total / $limit);

    $uri = $queryParams = $app->getRequest()->getRequestUri();
    $baseUri = preg_replace('/\?.*?$/', '', $uri);
    $queryParams = $app->getRequest()->query->all();

    $currentPage = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
?>

<?php if($pages > 1): ?>
<nav>
    <ul class="pagination">
        <?php for($p = 1; $p <= $pages; $p++): ?>
            <?php if($currentPage === $p): ?>
            <li class="active">
                <a href="#">
	                <?php echo $p; ?>
                </a>
            </li>
            <?php else: ?>
            <li>
                <a href="<?php echo $view->escape($baseUri) . '?' . http_build_query(array_merge($queryParams, ['page' => $p]));?>">
                    <?php echo $p; ?>
                </a>
            </li>
            <?php endif ?>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>