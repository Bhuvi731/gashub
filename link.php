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
if($_GET['pageid']==24)
{
    ?>
<li class="nav-item">
<a href="index.php?pageid=24" class="nav-link active">
<i class="nav-icon fa fa-upload"></i>
<p>
Add Banner
</p>
</a>
</li>
    <?php
}else{
    ?>
    <li class="nav-item">
<a href="index.php?pageid=24" class="nav-link">
<i class="nav-icon fa fa-upload"></i>
<p>
Add Banner

</p>
</a>
</li>
    <?php
}
?>

        <?php
        if ($_GET['pageid'] == 1) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=1" class="nav-link active">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=1" class="nav-link">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <p>
                        User

                    </p>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        if ($_GET['pageid'] == 5) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=5" class="nav-link active">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>
                        User Addresses

                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=5" class="nav-link">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>

                        User Addresses
                    </p>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        if ($_GET['pageid'] == 3) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=3" class="nav-link active">
                    <i class="nav-icon fa fa-registered"></i>
                    <p>
                        Vendors

                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=3" class="nav-link">
                    <i class="nav-icon fa fa-user"></i>
                    <p>
                        Vendors

                    </p>
                </a>
            </li>
        <?php
        }
        ?>

       
        <?php
        if ($_GET['pageid'] == 12) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=12" class="nav-link active">
                    <i class="nav-icon fa fa-registered"></i>
                    <p>
                        Brands

                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=12" class="nav-link">
                    <i class="nav-icon fa fa-store"></i>
                    <p>
                        Brands

                    </p>
                </a>
            </li>
        <?php
        }
        ?>

        <!-- <?php
        if ($_GET['pageid'] == 4) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=4" class="nav-link active">
                    <i class="nav-icon fas fa-gas-pump"></i>
                    <p>
                        Cylinder

                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=4" class="nav-link">
                    <i class="nav-icon fas fa-gas-pump"></i>
                    <p>
                        Cylinder

                    </p>
                </a>
            </li>
        <?php
        }
        ?> -->
        <!-- <?php
        if ($_GET['pageid'] == 14) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=14" class="nav-link active">
                    <i class="nav-icon fa fa-list-alt"></i>
                    <p>
                        Accessories

                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=14" class="nav-link">
                    <i class="nav-icon fa fa-list-alt"></i>
                    <p>
                        Accessories

                    </p>
                </a>
            </li>
        <?php
        }
        ?> -->
        <?php
        if ($_GET['pageid'] == 15 || $_GET['pageid'] == 16) {
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
                    if ($_GET['pageid'] == 15) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=15" class="nav-link active">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Cylinder Stock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=15" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Cylinder Stock
                                </p>
                            </a>
                        </li>
                    <?php
                    }
                    if ($_GET['pageid'] == 16) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=16" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Accessories Stock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=16" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Accessories Stock
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
                    if ($_GET['pageid'] == 15) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=15" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Cylinder Stock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=15" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Cylinder Stock
                                </p>
                            </a>
                        </li>
                    <?php
                    }
                    if ($_GET['pageid'] == 16) {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=16" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Accessories Stock
                                </p>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a href="index.php?pageid=16" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Accessories Stock
                                </p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
        <?php
        }
        ?>

        <?php
        if ($_GET['pageid'] == 8) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=8" class="nav-link active">
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
                <a href="index.php?pageid=8" class="nav-link">
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
        if ($_GET['pageid'] == 9) {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=9" class="nav-link active">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                        Feedback
                    </p>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a href="index.php?pageid=9" class="nav-link">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                        Feedback
                    </p>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>