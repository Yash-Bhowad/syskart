
<nav class="navbar  navbar-expand-lg bg-body-tertiary " >
  <div class="container-fluid">

    <a class="navbar-brand" href="#">SYSKART</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <?php if (!isset($_SESSION["username"]) || $_SESSION["loggedin"] != true): ?>
      <li class="nav-item">
        <span class="dropdown-hello"> 
          <strong>Hello, welcome to SYSKART </strong>
        </span>
      </li>

  <?php else: ?>
    <li class="nav-item">
    <span class="dropdown-hello"> <strong>Hello,
      <?php echo $_SESSION["username"]; ?> welcome to SYSKART
  </strong></span>
  </li>
  
<?php endif; ?>
</ul>

<?php include 'assets/search.php'; ?>
<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
  <li class="nav-item d-flex align-items-center">

  <!-- Cart Icon -->
  <li class="nav-item d-flex align-items-center">
  <?php if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != true): ?>

  <a class="nav-link position-relative" href="../cart.php">
    <i class="fas fa-shopping-cart text-white fs-5"></i>
    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0
   
    </span>
  </a>

  <?php endif; ?>
  </li>

  <!-- Profile Icon with Dropdown -->
  <li class="nav-item d-flex align-items-center">
  <div class="custom-profile-dropdown" id="customProfileDropdown">
 
  <i class="fas fa-user-circle custom-profile-icon" id="customProfileIcon"></i>

    <div class="custom-dropdown-menu" id="customDropdownMenu">
      <?php if (!isset($_SESSION["username"]) || $_SESSION["loggedin"] != true): ?>
        <a href="../login.php">Login</a>
        <a href="../register.php">Signup</a>
      <?php else: ?>
        <span class="dropdown-hello"> <strong>Hello, <?php echo $_SESSION["username"]; ?> </strong></span>
        <a href="../logout.php">Logout</a>
        
      <?php endif; ?>
    </div>
  </div>
      </li>
      </li>
      </ul>
    </div>
  </div>
</nav>


