
<!-- Page Content  -->
<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
			<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="btn btn-default mr-3">
							<i class="fas fa-align-left"></i>
							<!-- <span>Toggle Sidebar</span> -->
					</button>
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fas fa-align-justify"></i>
					</button>
					<h4 class="mb-0" id="badge-heading"><?php echo $heading; ?></h4>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="nav navbar-nav ml-auto">
									<li class="nav-item active">
											<a class="nav-link" href="<?php echo base_url() . $go_logout; ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
									</li>
							</ul>
					</div>
			</div>
	</nav>
	<div class="navbar mb-3">
		<div class="row">
			<div class="col pr-0 border-right">
				<button type="button" class="btn btn-default btn-md rounded-0 font-12" id="loadPage" data-badge-head="ADD MONTHLY BILLS" data-link="add-monthly-bills" data-ind="" data-cls="cont-add-member">
					<i class="fas fa-user-plus"></i> Add Monthly Bills
				</button>
			</div>
		</div>
	</div>
	<div class="navbar bg-light custom-container none">
		<table class="table font-12 w-100" id="tbl-monthly-bills">
			<thead>
				<tr>
					<th scope="col">MONTH</th>
					<th scope="col">DATE</th>
					<th scope="col">PLAN</th>
					<th scope="col">ACTION</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<div class="line"></div>
	</div>