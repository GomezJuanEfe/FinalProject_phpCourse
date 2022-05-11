<?php
include('./header.php');
?>
<main>
  <!-- LEFT SECTION-->
  <section class="sidebar">
    <img src="./img/profile.jpg" alt="Profile Picture" class="profile">
    <?php
      echo "<h2>". $_SESSION['userName'] . "</h2>";
      echo "<h4>". $_SESSION['userRoll'] . "</h4>";
    ?>
    <nav>
      <ul>
        <?php
          include("./pages/". $_SESSION['userRoll']. "/list.php");
        ?>
      </ul>
    </nav>
  </section>

  <!-- RIGHT SECTION-->
  <section class="mainpage">
    <article class="header">
      <img src="./img/logo.png" alt="Logo" class="logo">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button class="logout-btn" type="submit" name="logoutbtn" value="logout">Log Out</button>
      </form>
    </article>
    <article class="main-content">
      <!-- Dinamic content -->
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if ($_POST['logoutbtn'] == "logout") {
            session_unset();
            session_destroy();
            header('Location: Login.php');
            exit;
          }
        }
        if (isset($_GET['SA'])) {
          switch ($_GET['SA']) {
            case "1":
              include('./pages/super_admin/dashboard.php');
              break;
            case "2":
              include('./pages/super_admin/users.php');
              break;
            case "3":
              include('./pages/super_admin/locations.php');
              break;
            case "4":
              include('./pages/super_admin/create_spaces.php');
              break;
          }
        }
        if (isset($_GET['m'])) {
          switch ($_GET['m']) {
            case "1":
              include('./pages/manager/dashboard.php');
              break;
            case "2":
              include('./pages/manager/bookSpace.php');
              break;
            case "3":
              include('./pages/manager/users.php');
              break;
          }
        }
        if (isset($_GET['c'])) {
          switch ($_GET['c']) {
            case "1":
              include('./pages/customer/dashboard.php');
              break;
            case "2":
              include('./pages/customer/profile.php');
              break;
            case "3":
              include('./pages/customer/bookSpace.php');
              break;
          }
        }
      ?>
    </article>
  </section>
</main>
</body>

</html>