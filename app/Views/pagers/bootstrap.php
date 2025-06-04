<?php if ($pager->links()): ?>
    <nav>
        <ul class="pagination pagination-sm justify-content-center">
            <style>
                .pagination .page-link {
                    color: #f8f9fa;
                    background-color: #343a40;
                    border-color: #495057;
                    font-size: 0.8rem;
                    padding: 0.3rem 0.6rem;
                }

                .pagination .page-link:hover {
                    background-color: #495057;
                    color: #ffffff;
                }

                .pagination .page-item.active .page-link {
                    background-color: #212529;
                    border-color: #212529;
                    color: #fff;
                }

                .pagination .page-item.disabled .page-link {
                    background-color: #343a40;
                    color: #6c757d;
                    border-color: #495057;
                }
            </style>

            <?php if ($pager->hasPreviousPage()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="Primero">
                        <span aria-hidden="true">Primero</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Anterior">
                        <span aria-hidden="true">Anterior</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php foreach ($pager->links() as $link): ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>

            <?php if ($pager->hasNextPage()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Siguiente">
                        <span aria-hidden="true">Siguiente</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Último">
                        <span aria-hidden="true">Último</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>


