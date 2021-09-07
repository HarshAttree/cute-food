<?php
include 'includes/connect.php';
	if($_SESSION['admin_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>All orders</title>
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">

  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<style>
         *{
margin: 0;
padding: 0;
}


.wrappe{
width: 860px; 
margin: 0 auto;
}
.wrappe ul{
list-style: none;
margin-top: 1%;
margin-left:8%;
}
.wrappe ul li {
background: #262626;
width: 200px;
border: 1px solid #fff;
height: 50px;
border-radius:10px;
line-height: 50px;
text-align: center;
float: left;
color: #fff;
font-size: 10px;
position: relative;
font-family: poppins;
text-transform: uppercase;
font-weight: bold;
}
.wrappe ul li:hover{
background: crimson; 
}

.wrappe ul ul{
display: none;
}
.wrappe ul li:hover > ul{
display: block;
}
.wrappe ul ul ul{
margin-left: 170px;
top: 0;
position: absolute;
}

</style>




		 

</head>


<body>
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <header id="header" class="page-topbar">
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.php" style="margin-left:2vw;"class="brand-logo darken-1"><img src="pet-bowl.png" style="width:80px;height:40px;"><span style="color:black;">CUTE FOOD</span></a></h1></li>
                    </ul>
                </div>
            </nav>
        </div>
  </header>
  <div id="main">
    <div class="wrapper">
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                </div>
				<div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="routers/logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $name;?> <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $role;?></p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Food Menu</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan active"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
								<li class="<?php
								if(!isset($_GET['status'])){
										echo 'active';
									}?>
									"><a href="all-orders.php">All Orders</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
									while($row = mysqli_fetch_array($sql)){
									if(isset($_GET['status'])){
										$status = $row['status'];
									}
                                    echo '<li class='.(isset($_GET['status'])?($status == $_GET['status'] ? 'active' : ''): '').'><a href="all-orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                 <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i> Tickets</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="all-tickets.php">All Tickets</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="all-tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>			
            <li class="bold"><a href="users.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Users</a>
            </li>				
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <section id="content">
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">All Orders</h5>
              </div>
            </div>
          </div>
        </div>        <div class="container">
          <p class="caption">List of orders by customers with details</p>
          <div class="divider"></div>
       

<div id="work-collections" class="seaction">
             
					<?php
					if(isset($_GET['status'])){
						$status = $_GET['status'];
					}
					else{
						$status = '%';
					}
					$sql = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE '$status';");
					echo '<div class="row">
                <div>
                    <h4 class="header">List</h4>
                    <ul id="issues-collection" class="collection">';
					while($row = mysqli_fetch_array($sql))
					{
						$status = $row['status'];
						$deleted = $row['deleted'];
						echo '<li class="collection-item avatar">
                              <img class="mdi-content-content-paste red circle" src="log.PNG"></img>
							  <div class="wrappe">
							  <ul>
                              <li><span class="collection-header">Order No. '.$row['id'].'</span>
							  <ul>
                              <li><strong>Date:</strong> '.$row['date'].'</li>
                              <li><strong>Payment Type:</strong> '.$row['payment_type'].'</li>
							  </ul>
							  </li>
                              </ul>
                              </div>			<br><br><br>				  
							  <p><strong>Status:</strong> '.($deleted ? $status : '
							  <form method="post" action="routers/edit-orders.php">
							    <input type="hidden" value="'.$row['id'].'" name="id">
								<select name="status">
								<option value="Yet to be delivered" '.($status=='Yet to be delivered' ? 'selected' : '').'>Yet to be delivered</option>
								<option value="Delivered" '.($status=='Delivered' ? 'selected' : '').'>Delivered</option>
								<option value="Cancelled by Admin" '.($status=='Cancelled by Admin' ? 'selected' : '').'>Cancelled by Admin</option>
								<option value="Paused" '.($status=='Paused' ? 'selected' : '').'>Paused</option>								
								</select>
							  ').'</p><br>
                              <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li>';
							  
						$order_id = $row['id'];
						$customer_id = $row['customer_id'];
						$sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
						$sql3 = mysqli_query($con, "SELECT * FROM users WHERE id = $customer_id;");
							while($row3 = mysqli_fetch_array($sql3))
							{
							echo '<li class="collection-item">
                            <div class="row">
							<details> 
							<summary>Customer details</summary>
							<p><strong>Name: </strong>'.$row3['name'].'</p>
							<p><strong>Address: </strong>'.$row['address'].'</p>
							'.($row3['contact'] == '' ? '' : '<p><strong>Contact: </strong>'.$row3['contact'].'</p>').'	
							'.($row3['email'] == '' ? '' : '<p><strong>Email: </strong>'.$row3['email'].'</p>').'		
							'.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'								
                            </li></details>';	
                            							
							}
						while($row1 = mysqli_fetch_array($sql1))
						{
							$item_id = $row1['item_id'];
							$sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
							while($row2 = mysqli_fetch_array($sql2))
								$item_name = $row2['name'];
							echo '<li class="collection-item">
                            <div class="row">
                            <div class="col s7">
                            <p class="collections-title"><strong>#'.$row1['item_id'].'</strong> '.$item_name.'</p>
                            </div>
                            <div class="col s2">
                            <span>'.$row1['quantity'].' Pieces</span>
                            </div>
                            <div class="col s3">
                            <span>Rs. '.$row1['price'].'</span>
                            </div>
                            </div>
                            </li>';
						}
								echo'<li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title"> Total</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span><strong>Rs. '.$row['total'].'</strong></span>
                                            </div>';										
								if(!$deleted){
								echo '<button class="btn waves-effect waves-light right submit" style="background-color:#33cc00;" type="submit" name="action">Change Status
                                              <i class="mdi-content-clear right"></i> 
										</button>
										</form>';
								}
								echo'</div></li>';
					}
					?>
					</ul>
                </div>
              </div>
            </div>
        </div></section>
    </div>

  </div>
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2020 <a class="grey-text text-lighten-4" href="#" target="_blank"></a> SHREEHARSH PANDEY (19BCE1818) & HARSH SHARMA(19BCE1464)</span>
        
        </div>
    </div>
  </footer>
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['customer_id']==session_id())
		{
			header("location:orders.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>