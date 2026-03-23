<?php 

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != true ){
echo '
<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
  <li class="nav-item">
    <form class="d-flex" role="search" action="../index.php" method="GET">
      <div class="input-group">
        <input id="searchBox" class="form-control" type="search" name="q"  placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit" id="searchButton"><i class="fas fa-search"></i></button>
      </div>
    </form>
  </li>
</ul>
';
}
?>