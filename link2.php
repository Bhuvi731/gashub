<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<?php
if($_GET['pageid']=='')
{
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
}else
{
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
if($_GET['pageid']==3)
{
    ?>
<li class="nav-item">
<a href="index.php?pageid=3" class="nav-link active">
<i class="nav-icon fa fa-user"></i>
<p>
Vendors

</p>
</a>
</li>
    <?php
}else{
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
if($_GET['pageid']==4)
{
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
}else{
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
?>
<?php
if($_GET['pageid']==6)
{
    ?>
<li class="nav-item">
<a href="index.php?pageid=6" class="nav-link active">
<i class="nav-icon fa fa-list-alt"></i>
<p>
Products
</p>
</a>
</li>
    <?php
}else{
    ?>
    <li class="nav-item">
<a href="index.php?pageid=6" class="nav-link">
<i class="nav-icon fa fa-list-alt"></i>
<p>
Products
</p>
</a>
</li>
    <?php
}
?>
<?php
if($_GET['pageid']==7)
{
    ?>
<li class="nav-item">
<a href="index.php?pageid=7" class="nav-link active">
<i class="nav-icon fas fa-store-alt"></i>
<p>
Inventory
</p>
</a>
</li>
    <?php
}else{
    ?>
    <li class="nav-item">
<a href="index.php?pageid=7" class="nav-link">
<i class="nav-icon fas fa-store-alt"></i>
<p>
Inventory
</p>
</a>
</li>
    <?php
}
?>

</ul>
</nav>