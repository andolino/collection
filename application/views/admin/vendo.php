
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
		<div class="row w-100">
			<div class="col-1 pr-0 border-right">
				<select class="custom-select custom-select-sm" id="select-type">
					<option selected value="">All</option>
					<option value="1">By Vendo</option>
				</select>
			</div>
			<div class="col-2 pr-0 border-right d-none members_name_v">
				<select class="custom-select custom-select-sm font-12" name="members_name_v" id="members_name_v">
				<option selected hidden value="">All</option>
					<?php foreach($members as $row): ?>
						<option value="<?php echo $row->lgu_constituent_id; ?>"><?php echo strtoupper($row->last_name.', '.$row->first_name.' '.$row->middle_name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-9">
				<input type="hidden" name="sd" value="<?php echo date('Y-m-01'); ?>">
				<input type="hidden" name="ed" value="<?php echo date('Y-m-t'); ?>">
				<button type="button" class="btn btn-default btn-md rounded-0 font-12 filter_vendo">
					<i class="fas fa-calendar"></i> FILTER DATE
				</button>
				<button type="button" class="btn btn-default btn-md rounded-0 font-12" id="loadPage" data-badge-head="ADD VENDO" data-link="add-vendo" data-ind="" data-cls="cont-add-member">
					<i class="fas fa-user-plus"></i> Add Vendo
				</button>
				<a href="javascript:void(0);" class="btn btn-success btn-md rounded-0 font-12 print-filter-v-excel">
					<i class="fas fa-table"></i> PRINT EXCEL
				</a>
			</div>
		</div>
	</div>
	<div class="navbar bg-light custom-container none">
		<table class="table font-12 w-100" id="tbl-vendo">
			<thead>
				<tr>
					<th scope="col">NAME</th>
					<th scope="col">DATE</th>
					<th scope="col">AMOUNT COLLECTED</th>
					<th scope="col">ACTION</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<div class="line"></div>
		<div class="export-excel">
		<table class="d-none" id="tbl-vendo-excel" border="1">
			<tr>
        <th scope="col">NAME</th>
        <th scope="col">DATE</th>
        <th scope="col">AMOUNT COLLECTED</th>
			</tr>
      <?php $total = 0; ?>
			<?php foreach($data as $row): ?>
				<tr>
					<td><?php echo strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name); ?></td>
					<td><?php echo $row->date_applied; ?></td>
					<td><?php echo $row->amount; ?></td>
				</tr>	
        <?php $total += floatval(str_replace(',', '', $row->amount)) ?>
			<?php endforeach; ?>
      <tr>
				<td></td>
				<td><strong>TOTAL:</strong></td>
				<td><?php echo number_format($total, 2); ?></td>
			</tr>
		</table>
		</div>
	</div>