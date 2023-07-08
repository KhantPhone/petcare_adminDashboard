<?php 	
	require_once "../common/config.php";

	session_start();

    if (empty($_SESSION['user_name'])) {
    header('Location:login.php');

  }

 ?>



<!DOCTYPE html>*
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="../assets/library/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/library/fontawesome/fontawesome-all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="short icon" href="images/title-img.png">
</head>
<body>
	<!-- navigation	 -->
   <nav class="navbar navbar-expand-lg navbar-light bg-dark">  
  		<button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#myNavbar" >
   			 <span class="navbar-toggler-icon"></span>
  		</button>

  		<div class="collapse navbar-collapse" id="myNavbar">
  			<div class="container-fluid">
  				<div class="row">
  			 		<div class="col-xl-2 col-md-3 sidebar fixed-top"><a class="navbar-brand d-block text-center border-bottom text-white my-3 " href="#">AdminDashboard</a>
  			 			<div class="admin-info border-bottom py-3">
  			 				<?php 
  			 				  	$sql = "SELECT * FROM accounts WHERE member_name  = '$_SESSION[user_name]'";
								$result = mysqli_query($conn,$sql);
								$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
								

                                        foreach ($row as $value ) {
                                        	
                                        
  			 				 ?>

  			 				<img src="../assets/images/<?php echo $value['member_image'] ?>" alt="" class=" mr-2" style = "width: 45px; height: 45px; border-radius: 50%;">
  			 				<a href="#" class="text-white sidebar-link">
  			 					<?php echo $value['member_name'] ?>
  			 				</a>
  			 			<?php } ?>
  			 			</div>
  			 			<ul class="navbar-nav d-flex flex-column">
  			 				<li class="nav-item my-2 mt-3 ">			 					
  			 					<a href="index.php" class="nav-link text-white sidebar-link current">
  			 						<i class="fas fa-home text-light mr-2"></i>Home</a>   	
  			 				</li>
  			 				<li class="nav-item my-2">
  			 					<a href="#bookings" class="nav-link text-white sidebar-link">
  			 						<i class="fas fa-calendar-alt text-light mr-2"></i>Bookings</a>
  			 				</li>
  			 				<li class="nav-item my-2">
  			 					<a href="#accounts" class="nav-link text-white sidebar-link">
  			 						<i class="fas fa-user text-light mr-2"></i>Accounts</a>
  			 				</li>
  			 				<li class="nav-item my-2">
  			 					<a href="#posts" class="nav-link text-white sidebar-link">
  			 						<i class="fas fa-clipboard-list text-light mr-2"></i>Posts</a>
  			 				</li>
  			 			</ul>
  			 		</div>
  			 		<div class="col-xl-10 col-md-9 bg-dark fixed-top ml-auto top-navbar">
  			 			<div class="row py-3">
  			 				<div class="col-md-3">
  			 					<a href="#" class="nav-bar-brand text-white">Dashboard</a>
  			 				</div>
  			 				<div class="col-md-5">
  			 					<form>
  			 						<div class="input-group">
  			 							<input type="search" class="form-control search-input mr-2" placeholder="Search">
  			 							<button class="btn search-button"><i class="fa fa-search text-danger"></i></button>
  			 						</div>
  			 					</form>
  			 				</div>
  			 				<div class="col-md-4">
  			 					<ul class="navbar-nav icon-parent">
  			 						<li class="nav-item"><a href="#" class="nav-link">
  			 							<i class="fas fa-comments text-muted fa-lg icon-bullets"></i>
  			 						</a></li>
  			 						<li class="nav-item icon-parent"><a href="#" class="nav-link">
  			 							<i class="fas fa-bell text-muted fa-lg icon-bullets"></i>
  			 						</a></li>
  			 						<li class="nav-item ml-md-auto" data-toggle="modal" data-target="#sign-out"><a href="#" class="nav-link">
  			 							<i class="fas fa-sign-out-alt text-danger fa-lg"></i>
  			 						</a></li>
  			 					</ul>
  			 					
  			 				</div>
  			 			</div>
  			 		</div>	 			
    			</div>
  			</div>
  		</div> 
   </nav>
   <!-- modal-dialog -->
   <div class="modal" id="sign-out">
   		<div class="modal-dialog">
   			<div class="modal-content">
   				<div class="modal-header"> 
   					<h5>Want To Leave ?</h5>  	
   					<button class="close" type="button" data-dismiss="modal">&times;</button>				
   				</div>
   				<div class="modal-body"> 
   				 	<p>Press Log Out to Leave...</p>  					
   				</div>
   				<div class="modal-footer">
   				 	<button class="btn btn-success" data-dismiss="modal">Save Changes</button>   
   				 	<button class="btn btn-danger" data-dismiss="modal">Log Out</button>   					
   				</div>
   			</div>
   		</div>
   </div>
	<!-- website statistics section -->
	<section id="statistics">
		<div class="row mt-lg-5">
			<div class="col-xl-10 col-md-9 ml-auto">
				<div class="row mt-lg-5">
					<div class="col-sm-4 col-md-4 mt-3">
						<div class="card card-common">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<i class="fa fa-shopping-cart fa-3x text-warning"></i>
									<div class="Prices text-right text-secondary">
										<h5>Posts</h5>
										<h6>0</h6>
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary">
								<i class="fas fa-sync mr-5"></i>
								<span>Update Now</span>								
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 mt-3">
						<div class="card card-common">
							<div class="card-body">
								<?php 

                                    $sql = "SELECT * FROM bookings_record ORDER BY id DESC";
									$result = mysqli_query($conn,$sql);
									$counts = mysqli_fetch_all($result,MYSQLI_ASSOC);                                                           
								 ?>
								<div class="d-flex justify-content-between">
									<i class="fa fa-book fa-3x text-success"></i>
									<div class="Prices text-right text-secondary">
										<h5>Bookings</h5>
										<h6>
											<?php echo count($counts); ?>
										</h6>
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary">
								<i class="fas fa-sync mr-5"></i>
								<span>Update Now</span>								
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 mt-3">
						<div class="card card-common">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<i class="fa fa-users fa-3x text-info"></i>
									<div class="Prices text-right text-secondary">
										<h5>Users</h5>
										<h6>0</h6>
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary">
								<i class="fas fa-sync mr-5"></i>
								<span>Update Now</span>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- staff salary section -->
	<section id="bookings" class="mt-3">
		<div class="row mt-5">
			<div class="col-xl-10 col-md-9 ml-auto">
				<div class="row mt-3 ml-3">				  
						<h3 class="text-center font-weight-bolds">Latest Bookings</h3>
						<table class="table table-striped bg-light">
							 <thead>
                                    <tr class="font-weight-bold">
                                        
                                        <th>FIRSTNAME</th>
                                        <th>MIDDLENAME</th>
                                        <th>LASTNAME</th>
                                        <th>PHONE NUMBER</th>
                                        <th>EMAIL</th>
                                        <th>DATE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                               	<tbody>
                                    <?php
                                       
                                        $sql ="SELECT * FROM bookings_record ORDER BY id DESC";
                                        $query = $conn->query($sql);
                                        while($row = $query->fetch_assoc()){


                                    ?>
                                    <tr>
                                        
                                        <td><?php echo $row['FIRSTNAME'];?></td>
                                        <td><?php echo $row['MIDDLENAME'];?></td>
                                        <td><?php echo $row['LASTNAME'];?></td>
                                        <td><?php echo $row['PHONE'];?></td>
                                        <td><?php echo $row['EMAIL'];?></td>
                                        <td><?php echo $row['DATE'];?></td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> VIEW</a>
                                            <a href="#" class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i> EDIT</a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> DELETE</a>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                     ?>
                                </tbody>
                                	
						</table>
							
			  </div>
			</div>
		</div>
	</section>
	<!-- Recent Customer Activites -->
	<section id="activites" class="my-5">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-10 col-md-9 ml-auto">
					<div class="row">
						<div class="col-md-7">
							<h4 class="font-weight-bold">
								Recent Customer Activites
							</h4>
							<div class="accordion" id="accordion">
								<div class="card">
									<div class="card-header">
										<button class="btn btn-secondary btn-block py-2 text-left" data-toggle="collapse" data-target="#collapse1">
											<img src="images/cust1.jpeg" alt="" width="50" class="rounded mr-3">
											John Posted A Comment ...
										</button>
									</div>
									<div class="collapse show" id="collapse1" data-parent="#accordion">
										<div class="card-body">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis cumque perspiciatis quisquam praesentium tempore cupiditate animi a, dignissimos iste vitae nihil consequatur officia ab illo. Recusandae esse explicabo optio natus.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<button class="btn btn-secondary btn-block py-2 text-left" data-toggle="collapse" data-target="#collapse2">
											<img src="images/cust2.jpeg" alt="" width="50" class="rounded mr-3">
											Micky Posted A Comment ...
										</button>
									</div>
									<div class="collapse" id="collapse2" data-parent="#accordion">
										<div class="card-body">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis cumque perspiciatis quisquam praesentium tempore cupiditate animi a, dignissimos iste vitae nihil consequatur officia ab illo. Recusandae esse explicabo optio natus.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<button class="btn btn-secondary btn-block py-2 text-left" data-toggle="collapse" data-target="#collapse3">
											<img src="images/cust3.jpeg" alt="" width="50" class="rounded mr-3">
											Markian Posted A Comment ...
										</button>
									</div>
									<div class="collapse" id="collapse3" data-parent="#accordion">
										<div class="card-body">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis cumque perspiciatis quisquam praesentium tempore cupiditate animi a, dignissimos iste vitae nihil consequatur officia ab illo. Recusandae esse explicabo optio natus.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<button class="btn btn-secondary btn-block py-2 text-left" data-toggle="collapse" data-target="#collapse4">
											<img src="images/cust4.jpeg" alt="" width="50" class="rounded mr-3">
											Nicky Posted A Comment ...
										</button>
									</div>
									<div class="collapse" id="collapse4" data-parent="#accordion">
										<div class="card-body">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis cumque perspiciatis quisquam praesentium tempore cupiditate animi a, dignissimos iste vitae nihil consequatur officia ab illo. Recusandae esse explicabo optio natus.
										</div>
									</div>									
								</div>	
								<div class="card">
									<div class="card-header">
										<button class="btn btn-secondary btn-block py-2 text-left" data-toggle="collapse" data-target="#collapse5">
											<img src="images/cust5.jpeg" alt="" width="50" class="rounded mr-3">
											Maria Posted A Comment ...
										</button>
									</div>
									<div class="collapse" id="collapse5" data-parent="#accordion">
										<div class="card-body">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis cumque perspiciatis quisquam praesentium tempore cupiditate animi a, dignissimos iste vitae nihil consequatur officia ab illo. Recusandae esse explicabo optio natus.
										</div>
									</div>									
								</div>	
								<div class="card">
									<div class="card-header">
										<button class="btn btn-secondary btn-block py-2 text-left" data-toggle="collapse" data-target="#collapse6">
											<img src="images/cust6.jpeg" alt="" width="50" class="rounded mr-3">
											Bobby Posted A Comment ...
										</button>
									</div>
									<div class="collapse" id="collapse6" data-parent="#accordion">
										<div class="card-body">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis cumque perspiciatis quisquam praesentium tempore cupiditate animi a, dignissimos iste vitae nihil consequatur officia ab illo. Recusandae esse explicabo optio natus.
										</div>
									</div>									
								</div>							
							</div>	
						</div>
						<div class="col-md-5">
							<div class="card">
								<div class="card-body">
									<h5 class="text-center text-muted">Quick Status Post</h5>	
								</div>
								<ul class="list-inline text-center mb-4">
									<li class="list-inline-item">
										<a href="#">
											<i class="fas fa-pencil-alt text-success"></i>
											<span class="text-muted">Status</span>
										</a>
									</li>
									<li class="list-inline-item">
										<a href="#">
											<i class="fas fa-camera text-info"></i>
											<span class="text-muted">Photo</span>
										</a>
									</li>
									<li class="list-inline-item">
										<a href="#">
											<i class="fas fa-map-marker text-primary"></i>
											<span class="text-muted">Check in</span>
										</a>
									</li>
								</ul>
								<form action="">
									<div class="form-group ml-2 mr-2">
										<input type="text" class="form-control" placeholder="What's ur Status">
										<button class="btn btn-info btn-block mt-3 mb-5">
											Submit Post
										</button>
									</div>
								</form>
								<div class="row ml-2 mr-2 mb-3">
									<div class="col-md-6">
										<div class="card bg-light text-center">
											<i class="far fa-calendar-alt fa-8x text-warning mt-3"></i>
											<div class="card-body">										<p class="card-text test-uppercase font-weight-bold">
													Wed,June 6
												</p>
											</div>
										</div>
									</div>
									<div class="col-md-6 ">
										<div class="card bg-light text-center">
											<i class="far fa-clock fa-8x text-info mt-3"></i>
											<div class="card-body">										<p class="card-text test-uppercase font-weight-bold">
													11:46 PM
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- footer --><!-- 
	<section id="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-10 col-md-9 ml-auto">
					<div class="row">
						<div class="col-md-6">
							<ul class="text-center list-inline-item">
								<a href="#">
								<li class="list-inline-item mr-3 text-muted">Code And Create</li>
								</a>
								<a href="#">
								<li class="list-inline-item mr-3 text-muted">About</li>
								</a>
								<a href="#">
								<li class="list-inline-item mr-3 text-muted">Support</li>
								</a>
								<a href="#">
								<li class="list-inline-item mr-3 text-muted">Blog</li>
								</a>								
							</ul>
						</div>
						<div class="col-md-6">
							<ul class="list-inline-item text-center">
								<a href="#">
									<li class="list-inline-item text-muted">
										&copy; 2018 Copyrights.Made With <span><i class="fa fa-heartbeat text-danger"></i>
										</span>by <span class="text-success">CodeAndCreate.....</span>
									</li>
								</a>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->


	<script src="../assets/library/bootstrap/jquery-3.4.1.slim.min.js"></script>
	<script src="../assets/library/bootstrap/popper.min.js"></script>
	<script src="../assets/library/bootstrap/bootstrap.min.js"></script>
	<script src="../js/script.js"></script>
</body>
</html>





