<div class="cont-view-member row none">
	<div class="col-12">
		<a href="javascript:void(0);" class="float-right pr-2 pb-2" id="loadPage" data-link="tbl-constituent-list" data-badge-head="CONSTITUENT LIST"
   								data-cls="cont-tbl-constituent" data-placement="top" data-toggle="tooltip" title="Back to List"><i class="fas fa-times"></i></a>
	</div>
	<div class="col-2">
		<div class="picture-cont text-center">
				<?php if ($uploads && @file_exists('assets/image/uploads/' . $uploads->image_name)): ?>
					<img id="lgu-captured-image" src="<?php echo base_url('assets/image/uploads/') . $uploads->image_name; ?>" class="img-thumbnail">
				<?php else: ?>
					<img id="lgu-captured-image" src="<?php echo base_url('assets/image/misc/default-user-member-image.png'); ?>" class="img-thumbnail">
				<?php endif; ?>
				<div class="upload-ctrl none">
					<a href="#" onclick="doUploadDb();"><i class="fas fa-camera-retro"></i></a>
				</div>
				<form id="frm-upload-dp">
					<input type="hidden" class="lgu-cons-id" value="<?php echo $data[0]->lgu_constituent_id; ?>" name="lgu-cons-id">
					<input type="file" class="d-none" id="upload-file-dp" name="upload-file-dp">
				</form>
		</div>
	</div>
	<div class="col-10">

			<div class="row">
					<!-- heading -->
					<div class="col-12 mb-3">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> Personal Info</h6>
						</div>
					</div>

					<div class="col-12 mt-2">
						<div class="card">
					    <div class="card-body">
					      <div class="row">
					      	<div class="col-2">
						      	<label class="card-title font-12">House Owner?</label>
						      	<p class="card-text font-12"><?php echo $data[0]->is_house_owner == '1' ? 'Yes' : 'No'; ?></p>
						      </div>
						      <div class="col-3">
						      	<label class="card-title font-12">Living Status</label>
						      	<p class="card-text font-12">
						      		<?php $dataSocialStatus = array(); ?>
						      			<?php foreach ($socialStatus as $row): ?>
							      			<?php echo $livingStatus[$row->status_id] . ' ID : ' . $row->id . ' <br>'; ?>
							      		<?php endforeach; ?>
						      	</p>
						      </div>
						      <div class="col-3">
						      	<label class="card-title font-12">Name</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->last_name . ', ' . $data[0]->first_name . ' ' . $data[0]->middle_name); ?></p>
						      </div>
						      <div class="col-3">
						      	<label class="card-title font-12">Nickname:</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->other_name); ?></p>
						      </div>
						      <div class="col-1">
						      	<label class="card-title font-12">Gender</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->gender); ?></p>
						      </div>
						      <div class="col-1">
						      	<label class="card-title font-12">Age</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->age); ?></p>
						      </div>
						      <div class="col-2">
						      	<label class="card-title font-12">Birth Date</label>
						      	<p class="card-text font-12"><?php echo date('F j, Y', strtotime($data[0]->dob)); ?></p>
						      </div>
						      <div class="col-2 mt-3">
						      	<label class="card-title font-12">Citizenship</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->citizenship); ?></p>
						      </div>
						      <div class="col-2 mt-3">
						      	<label class="card-title font-12">Civil Status</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->civil_status); ?></p>
						      </div>
						      <div class="col-2 mt-3">
						      	<label class="card-title font-12">Office Address</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->ofc_address); ?></p>
						      </div>
						      <div class="col-2 mt-3">
						      	<label class="card-title font-12">House Type</label>
						      	<p class="card-text font-12"><?php echo strtoupper($residential($data[0]->house_type)->residential_type); ?></p>
						      </div>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- end -->

					<!-- heading -->
					<div class="col-12 mb-3 mt-4">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-address-card"></i> Contact Details</h6>
						</div>
					</div>
					<div class="col-12 mt-2">
						<div class="card">
					    <div class="card-body">
					      <div class="row">
						      <div class="col-4">
						      	<label class="card-title font-12">Residential Address</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->residential_address); ?></p>
						      </div>
						      <div class="col-4">
						      	<label class="card-title font-12">Email</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->email); ?></p>
						      </div>
						      <div class="col-2">
						      	<label class="card-title font-12">Telephone #:</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->tel_no); ?></p>
						      </div>
						      <div class="col-2">
						      	<label class="card-title font-12">Mobile #:</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->mobile); ?></p>
						      </div>
						      <div class="col-12"></div>
						      <?php foreach ($govtID as $row): ?>
						      	<div class="col-3 mt-3">
							      	<label class="card-title font-12"><?php echo strtoupper($row->card_name); ?></label>
											<p class="card-text font-12">
											<?php echo $row->id_number; ?>
											</p>
					      		</div>
						      <?php endforeach; ?>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- end -->
					
					<!-- heading -->
					<div class="col-12 mb-3 mt-4">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-child"></i> Family Background</h6>
						</div>
					</div>
					<div class="col-12 mt-2">
						<div class="card">
					    <div class="card-body">
					      <div class="row">
						      <div class="col-3">
						      	<label class="card-title font-12">Father's Name</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->fathers_name); ?></p>
						      </div>
						      <div class="col-3">
						      	<label class="card-title font-12">Father's Birth Place</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->fathers_birth_place); ?></p>
						      </div>
						      <div class="col-3">
						      	<label class="card-title font-12">Mother's Name</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->mothers_name); ?></p>
						      </div>
						      <div class="col-3">
						      	<label class="card-title font-12">Mother's Birth Place</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->mothers_birth_place); ?></p>
						      </div>
						      <div class="col-3 mt-3">
						      	<label class="card-title font-12">Spouse Name</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->spouce_name); ?></p>
						      </div>
						      <div class="col-3 mt-3">
						      	<label class="card-title font-12">Spouse Birth Place</label>
						      	<p class="card-text font-12"><?php echo strtoupper($data[0]->spouce_birth_place); ?></p>
						      </div>
						      <div class="col-12"></div>
						      <?php $an = 1; ?>
					      	<?php foreach ($child as $row): ?>
						      	<div class="col-3 mt-3">
							      	<label class="card-title font-12">Child #<?php echo $an; ?></label>
											<p class="card-text font-12">
											<?php echo strtoupper($row->name); ?>
											</p>
					      		</div>
					      		<div class="col-3 mt-3">
							      	<label class="card-title font-12">Birth Place</label>
											<p class="card-text font-12">
											<?php echo strtoupper($row->birthplace); ?>
											</p>
					      		</div>
					      	<?php $an++; ?>
						      <?php endforeach; ?>

					      </div>
					    </div>
					  </div>
					</div>
					<!-- end -->

					<!-- heading -->
					<div class="col-12 mb-3 mt-4">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-child"></i> Other Information</h6>
						</div>
					</div>
					<div class="col-12 mt-2">
						<div class="card">
					    <div class="card-body">
					      <div class="row">
					      	<div class="col-3">
						      	<label class="card-title font-12">Highest Education Attainment</label>
										<p class="card-text font-12">
										<?php echo strtoupper($education($data[0]->highest_educ_attmnt)->education_name); ?>
										</p>
				      		</div>
				      		<div class="col-3">
						      	<label class="card-title font-12">Occupation</label>
										<p class="card-text font-12">
										<?php echo strtoupper($data[0]->occupation); ?>
										</p>
				      		</div>
				      		<div class="col-3">
						      	<label class="card-title font-12">Religion</label>
										<p class="card-text font-12">
										<?php 
											switch ($data[0]->religion) {
												case '1':
													echo 'Catholic';
													break;
												case '2':
													echo 'Muslim';
													break;
												default:
													echo $data[0]->religion_desc;
													break;
											}
										?>
										</p>
				      		</div>
				      		<div class="col-3">
						      	<label class="card-title font-12">Height</label>
										<p class="card-text font-12">
										<?php echo strtoupper($data[0]->height); ?>
										</p>
				      		</div>
				      		<div class="col-3 mt-3">
						      	<label class="card-title font-12">Weight</label>
										<p class="card-text font-12">
										<?php echo strtoupper($data[0]->weight); ?>
										</p>
				      		</div>
				      		<div class="col-3 mt-3">
						      	<label class="card-title font-12">Identifying Marks</label>
										<p class="card-text font-12">
										<?php echo strtoupper($data[0]->identifying_marks); ?>
										</p>
				      		</div>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- end -->

					<!--  -->


					

			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>

	</div>
</div>