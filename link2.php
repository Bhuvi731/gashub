<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        if ($_GET['pageid'] == '') {
        ?>
            <li class="nav-item menu-open">
                <a href="index.php" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

            </li>
        <?php
        } else {
        ?>
            <li class="nav-item menu-open">
                <a href="index.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

            </li>
        <?php
        }
        ?>
        <?php
        if ($_GET['pageid'] == 19) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=19" class="nav-link active">
                    <i class="nav-icon fa fa-store"></i>
                    <p>
                        Brands

                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=19" class="nav-link">
                    <i class="nav-icon fa fa-store"></i>
                    <p>
                        Brands

                    </p>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        if ($_GET['pageid'] == 22 || $_GET['pageid'] == 23) {
        ?>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fa-solid fa-coins"></i>
                    <p>
                        Inventory
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <?php
                    if ($_GET['pageid'] == 22) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=22" class="nav-link active">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    cylinderstock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=22" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    cylinderstock
                                </p>
                            </a>
                        </li>
                    <?php
                    }
                    if ($_GET['pageid'] == 23) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=23" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    accessoriesstock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=23" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    accessoriesstock
                                </p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-coins"></i>
                    <p>
                        Inventory
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <?php
                    if ($_GET['pageid'] == 22) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=22" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    cylinderstock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=22" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    cylinderstock
                                </p>
                            </a>
                        </li>
                    <?php
                    }
                    if ($_GET['pageid'] == 23) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=23" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    accessoriesstock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=23" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    accessoriesstock
                                </p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </li>
            <?php
            if ($_GET['pageid'] == 26) {
            ?>
                <li class="nav-item">
                    <a href="index.php?pageid=26" class="nav-link active">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Order Management

                        </p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a href="index.php?pageid=26" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Order Management

                        </p>
                    </a>
                </li>
            <?php
            }
            ?>
            <?php
            if ($_GET['pageid'] == 25) {
            ?>
                <li class="nav-item">
                    <a href="index.php?pageid=25" class="nav-link active">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            Feedback

                        </p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a href="index.php?pageid=25" class="nav-link">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            Feedback

                        </p>
                    </a>
                </li>
            <?php
            }
            ?>
        <?php
        }
        ?>


    </ul>
</nav>