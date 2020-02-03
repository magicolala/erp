<?php
require_once 'db.php';
if ($_SESSION['auth']->privileges == 'custom') {
    $pagees = unserialize($_SESSION['auth']->pages);
} elseif ($_SESSION['auth']->PrType_id) {
    $prType = query($db, 'SELECT * FROM PrTypes WHERE id =' . $_SESSION['auth']->PrType_id);
    $pagees = unserialize($prType->pages);
} else {
    $pagees = [];
    foreach ($pages as $key => $value) {
        $pagees[] = (string)$key;
    }
}
?>

<div class="left-side-menu">
    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>
                <?php if (in_array('0', $pagees)): ?>
                <li>
                    <a href="index.php">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <?php if (in_array('1',$pagees) || in_array('2', $pagees)):  ?>
                    <a href="javascript: void(0);">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span> Catégories </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('1', $pagees)): ?>
                        <li>
                            <a href="categories.php">Liste des catégories</a>
                        </li>
                        <?php endif; ?>
                        <?php if (in_array('2', $pagees)): ?>
                        <li>
                            <a href="category-add.php">Ajouter</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="category-edit.php" style="display: none;">edition</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <?php if (in_array('3',$pagees) || in_array('4', $pagees)): ?>
                    <a href="javascript: void(0);">
                        <i class="fab fa-product-hunt"></i>
                        <span> Produits </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('3', $pagees)): ?>
                            <li>
                                <a href="products.php">Liste des produits</a>
                            </li>
                        <?php endif; ?>
                        <?php if (in_array('4', $pagees)): ?>
                        <li>
                            <a href="product-add.php">Ajouter</a>
                        </li>
                        <?php endif; ?>
                        <?php if (in_array('5', $pagees)): ?>
                        <li>
                            <a href="supplies.php">Entrée de stock</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="product-edit.php" style="display: none;">edition</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <?php if (in_array('6',$pagees) || in_array('7', $pagees)): ?>
                        <a href="javascript: void(0);">
                            <i class="fas fa-users"></i>
                            <span> Clients </span>
                            <span class="menu-arrow"></span>
                        </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('6', $pagees)): ?>
                        <li>
                            <a href="clients.php">Liste des clients</a>
                        </li>
                        <?php endif; ?>
                        <?php if (in_array('7', $pagees)): ?>
                        <li>
                            <a href="client-add.php">Ajouter</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="client-edit.php" style="display: none;">edition</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <?php if (in_array('8',$pagees) || in_array('9', $pagees)): ?>
                    <a href="javascript: void(0);">
                        <i class="fab fa-r-project"></i>
                        <span> Fournisseurs </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('8', $pagees)): ?>
                        <li>
                            <a href="providers.php">Liste des fournisseurs</a>
                        </li>
                        <?php endif; ?>
                        <?php if (in_array('9', $pagees)): ?>
                        <li>
                            <a href="provider-add.php">Ajouter</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="provider-edit.php" style="display: none;">edition</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <?php if (in_array('10',$pagees) || in_array('11', $pagees)): ?>
                    <a href="javascript: void(0);">
                        <i class="fas fa-receipt"></i>
                        <span> Devis </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('10', $pagees)): ?>
                        <li>
                            <a href="quotations.php">Liste des devis</a>
                        </li>
                        <?php endif ?>
                        <?php if (in_array('11', $pagees)): ?>
                        <li>
                            <a href="quotation-add.php">Ajouter</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="quotation-edit.php" style="display: none;">edition</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <?php if (in_array('12',$pagees) || in_array('13', $pagees)): ?>
                    <a href="javascript: void(0);">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span> Factures </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('12', $pagees)): ?>
                        <li>
                            <a href="invoices.php">Liste des factures</a>
                        </li>
                        <?php endif; ?>
                        <?php if (in_array('13', $pagees)): ?>
                        <li>
                            <a href="invoice-add.php">Ajouter</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="invoice-edit.php" style="display: none;">edition</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <?php if (in_array('14',$pagees) || in_array('15', $pagees)): ?>
                        <a href="javascript: void(0);">
                            <i class="fas fa-user"></i>
                            <span> Utilisateurs </span>
                            <span class="menu-arrow"></span>
                        </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('14', $pagees)): ?>
                        <li>
                            <a href="users.php">Liste des utilisateurs</a>
                        </li>
                        <?php endif; ?>
                        <?php if (in_array('15', $pagees)): ?>
                        <li>
                            <a href="user-add.php">Ajouter</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="user-edit.php" style="display: none;">edition</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <?php if (in_array('16',$pagees)): ?>
                    <a href="javascript: void(0);">
                        <i class="fa fa-history" aria-hidden="true"></i>
                        <span> Actions </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <?php endif; ?>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if (in_array('16', $pagees)): ?>
                        <li>
                            <a href="logs.php">Liste des actions</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li>
                    <a href="stats.php">
                        <i class="fas fa-chart-bar"></i>
                        <span> Statistiques </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>