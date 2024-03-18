<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body{
  min-height: 100vh;
  background: url(bg.jpg)no-repeat;
  background-size: cover;
  background-position: center;
}

.side-bar{
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(15px);
  width: 290px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: -100%;
  overflow-y: auto;
  transition: 0.6s ease;
  transition-property: left;
}

.side-bar.active{
  left: 0;
}

.side-bar .menu{
  width: 100%;
  margin-top: 80px;
}

.side-bar .menu .item{
  position: relative;
  cursor: pointer;
}

.side-bar .menu .item  {
  color: #000;
  font-size: 14px; 
  text-decoration: none;
  display: block;
  padding: 8px 20px;
  line-height: 40px; 
}

.side-bar .menu .item a{
  color: #000;
  font-size: 16px;
  text-decoration: none;
  display: block;
  padding: 5px 30px;
  line-height: 60px;
}

.side-bar .menu .item a:hover{
  background: #8621F8;
  transition: 0.3s ease;
}

.side-bar .menu .item i{
  margin-right: 15px;
}

.side-bar .menu .item a .dropdown{
  position: absolute;
  right: 0;
  margin: 20px;
  transition: 0.3s ease;
}

.side-bar .menu .item .sub-menu{
  background: rgba(255, 255, 255, 0.1);
  display: none;
}

.side-bar .menu .item .sub-menu a{
  padding-left: 80px;
}

.rotate{
  transform: rotate(90deg);
}

#content-container {
        display: absolute;
        justify-content: center;
        align-items: center;
        /* height: 100%; */
        text-align: center;
        /* left: 200px; */
    }

    </style>
  </head>
  <body>

    <div class="menu-btn">
      <i class="fas fa-bars"></i>
    </div>
    <div class="side-bar">
      <div class="close-btn">
        <i class="fas fa-times"></i>
      </div>
      <div class="menu">
        <div class="item"><a href="index.php"><i class="fas fa-desktop"></i>Dashboard</a></div>
        <div class="item">
          <a class="sub-btn"><i class="fas fa-table"></i>Admin<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="branch.php" class="sub-item">Add Branch</a>
            <a href="registration.php" class="sub-item">Add User</a>
          </div>
        </div>
        <div class="item"><a href="customer_register.php"><i class="fas fa-th"></i>Customer Register</a></div>
        <div class="item"><a href="itemMaster.php"><i class="fa fa-cart-arrow-down"></i>Item Master</a></div>

        <div class="item">
          <a class="sub-btn"><i class="fas fa-cogs"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="category.php" class="sub-item">Category </a>
            <a href="department.php" class="sub-item">Department </a>
            <a href="supplier.php" class="sub-item">Supplier</a>

          </div>
        </div>
        <div class="item"><a href="logout.php"><i class="fas fa-info-circle"></i>Exit</a></div>
      </div>
    </div>
    <section class="main">
    <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Welcome to the <span class="text-warning">Dashboard</span></h1>
                <div id="content-container"></div>
            </div>
    </div>

    </section>

    <script type="text/javascript">
    $(document).ready(function(){
      //jquery for toggle sub menus
      $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });

      //jquery for expand and collapse the sidebar
      $('.menu-btn').click(function(){
        $('.side-bar').addClass('active');
        $('.menu-btn').css("visibility", "hidden");
      });

      $('.close-btn').click(function(){
        $('.side-bar').removeClass('active');
        $('.menu-btn').css("visibility", "visible");
      });

      function loadContent(page) {
            $.ajax({
                url: page,
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                    var loadedContent = $('<div class="loaded-content"></div>').html(data);
                    $('#content-container').html(loadedContent);
                },
                error: function (xhr, status, error) {
                    console.error('Error loading content:', error);
                }
            });
        }

        loadContent('customer_register.php');

        // Handle sidebar item clicks
        $('.side-bar .menu .item a').on('click', function (event) {
            event.preventDefault();
            var page = $(this).attr('href');
            loadContent(page);
        });
    });
    </script>
<!-- 
<style>
    .loaded-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        text-align: center;
    }
</style> -->
  </body>
</html>
