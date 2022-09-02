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
if($_GET['pageid']==1)
{
    ?>
<li class="nav-item">
<a href="index.php?pageid=1" class="nav-link active">
<i class="nav-icon fa fa-registered"></i>
<p>
Registration

</p>
</a>
</li>
    <?php
}else{
    ?>
    <li class="nav-item">
<a href="index.php?pageid=1" class="nav-link">
<i class="nav-icon fa fa-registered"></i>
<p>
Registration

</p>
</a>
</li>
    <?php
}
?>
<?php
if($_GET['pageid']==5)
{
    ?>
<li class="nav-item">
<a href="index.php?pageid=5" class="nav-link active">
<i class="nav-icon fas fa-address-card"></i>
<p>
User Address
</p>
</a>
</li>
    <?php
}else{
    ?>
    <li class="nav-item">
<a href="index.php?pageid=5" class="nav-link">
<i class="nav-icon fas fa-address-card"></i>
<p>
User Address
</p>
</a>
</li>
    <?php
}
?>
<?php
if($_GET['pageid']==8)
{
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
}else{
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
if($_GET['pageid']==9)
{
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
}else{
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