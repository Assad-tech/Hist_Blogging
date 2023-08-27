<?php
	// session_start();
include("include/header.php");
?>

<div class="container-fluid">
	<div class="row">


		<!-- Blogger Profile Detalis -->
		<div class="col-lg-6 col-md-6 col-sm-12 side-bar">
			<table class="table mt-2 table-borderless blogger-profile" id="blogger-profile ">
				<thead class="blogger-profile-table">
					<tr>
						<th scope="col" class="w-25">
							<img class="blogger-profile-table-img w-100 rounded-circle m-0 p-0" src="../<?php echo $_SESSION['user']['user_image']?>">
						</th>
						<th scope="col" class="h2 pb-3"><?php echo $_SESSION['user']['first_name']?></th>
						<th scope="col"><button onclick="edit_admin_profile(<?php echo $_SESSION['user']['user_id']?>)" class=" activity-btns rounded-0 ">Edit Profile</button></th>
					</tr>
					<tr>
						<th></th>
						<td class="text-light fst-italic m-0 p-0"> Admin of Technological Analysis</td>
						<th></th>
					</tr>
					<tr>
						<th colspan="3" class="m-0 p-0">
							<hr>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bg-light"></td>
						<th>User Id:</th>
						<td><?php echo $_SESSION['user']['user_id']?></td>
					</tr>
					<tr>
						<td class="bg-light"></td>
						<th>Email:</th>
						<td><?php echo $_SESSION['user']['email']?></td>
					</tr>
					<tr>
						<td class="bg-light"></td>
						<th>Password:</th>
						</th>
						<td>12345</td>
					</tr>
					<tr>
						<td class="bg-light"></td>
						<th>Date of Birth:</th>
						</th>
						<td><?php echo $_SESSION['user']['date_of_birth']?></td>
					</tr>
					<tr>
						<td class="bg-light"></td>
						<th>Gender:</th>
						</th>
						<td>Male</td>
					</tr>
					<tr>
						<td class="bg-light"></td>
						<th>Accout Status:</th>
						</th>
						<td>Active</td>
					</tr>
					<tr>
						<td class="bg-light"></td>
						<th>Accout Created At:</th>
						</th>
						<td>3-23-2022 10:45 pm</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Edit Profile Form -->
		<div class="col-lg-6 col-md-6 col-sm-12 mt-2 form-area table-responsive" id="edit_admin_profile">

		</div>
	</div>
</div>

<?php
include("include/footer.php");
?>