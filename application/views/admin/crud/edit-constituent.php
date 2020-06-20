<div class="cont-edit-member row none">
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
				<input type="hidden" class="lgu-cons-id" value="<?php echo $lgu_constituent->lgu_constituent_id; ?>" name="lgu-cons-id">
				<input type="file" class="d-none" id="upload-file-dp" name="upload-file-dp">
			</form>
		</div>
	</div>
	<div class="col-10">
		<form id="frm-add-constituent">
			<input type="hidden" id="is_update" value="<?php echo $lgu_constituent->lgu_constituent_id; ?>" name="is_update">
			<div class="row">
					<!-- heading -->
					<div class="col-12 mb-3">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> Personal Info</h6>
						</div>
					</div>
					<!-- end -->
					<div class="col-12 pb-2">
						<div class="custom-control custom-checkbox">
						  <input type="checkbox" class="custom-control-input" id="is_house_owner" value="1" name="is_house_owner" <?php echo $lgu_constituent->is_house_owner == '1' ? 'checked=""' :  ''; ?>>

						  <label class="custom-control-label font-12" for="is_house_owner">House Owner?</label>
						</div>
					</div>
					<div class="col-12 ss-cont mb-3">
			      <label for="social_status" class="font-12">Living Status</label>
			      <div class="row">
			      	<?php foreach ($livingStatus as $row): ?>
			      		<div class="col-sm pr-0">
				      		<div class="custom-control custom-checkbox social_status<?php echo $row->living_status_id; ?>">
									  <?php if (in_array($row->living_status_id, $social_status)): ?>
									  	<input type="checkbox" class="custom-control-input" id="social_status<?php echo $row->living_status_id; ?>" value="<?php echo $row->living_status_id; ?>" name="social_status[]" checked>
									  	<label class="custom-control-label font-12" for="social_status<?php echo $row->living_status_id; ?>"><?php echo $row->name; ?>?</label>
									  	<input type="text" class="form-control form-control-sm mt-2" id="pwd_id" value="<?php echo $socialStatusIDNum[$row->living_status_id]; ?>" name="pwd_id[]" placeholder="ID #">
									  <?php else: ?>
									  	<input type="checkbox" class="custom-control-input" id="social_status<?php echo $row->living_status_id; ?>" value="<?php echo $row->living_status_id; ?>" name="social_status[]">
									  	<label class="custom-control-label font-12" for="social_status<?php echo $row->living_status_id; ?>"><?php echo $row->name; ?>?</label>
									  <?php endif; ?>
									  
									</div>
				      	</div>
			      	<?php endforeach; ?>
		      	</div>
			      <!-- <select class="custom-select custom-select-sm" id="social_status" name="social_status">
						  <option selected hidden value="">-SELECT-</option>
						  <option value="1">Person with disability</option>
						  <option value="2">Senior Citizen</option>
						  <option value="3">Solo Parent</option>
						  <option value="4">4Ps Benificiary</option>
						</select> -->
			    </div>
					<div class="col-3">
						<label for="last_name" class="font-12">Last Name</label>
						<input type="text" class="form-control form-control-sm" id="last_name" name="last_name" placeholder="..." value="<?php echo $lgu_constituent->last_name; ?>">
					</div>
					<div class="col-3 pl-0">
						<label for="first_name" class="font-12">First Name</label>
						<input type="text" class="form-control form-control-sm" id="first_name" name="first_name" placeholder="..." value="<?php echo $lgu_constituent->first_name; ?>">
					</div>
					<div class="col-3 pl-0">
						<label for="middle_name" class="font-12">Middle Name</label>
						<input type="text" class="form-control form-control-sm" id="middle_name" name="middle_name" placeholder="..." value="<?php echo $lgu_constituent->middle_name; ?>">
					</div>
					<div class="col-3 pl-0">
						<label for="other_name" class="font-12">AKA/Nickname/Other Name</label>
						<input type="text" class="form-control form-control-sm" id="other_name" name="other_name" placeholder="..." value="<?php echo $lgu_constituent->other_name; ?>">
					</div>
					<div class="col-3 mt-2">
						<label for="gender" class="font-12">Gender</label>
						<select class="custom-select custom-select-sm" id="gender" name="gender">
						  <option selected hidden value="">-SELECT-</option>
						  <option value="MALE" <?php echo $lgu_constituent->gender == 'MALE' ? 'selected' : ''; ?>>MALE</option>
						  <option value="FEMALE" <?php echo $lgu_constituent->gender == 'FEMALE' ? 'selected' : ''; ?>>FEMALE</option>
						</select>
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="age" class="font-12">Age</label>
						<input type="text" class="form-control form-control-sm" id="age" name="age" placeholder="..." value="<?php echo $lgu_constituent->age; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="dob" class="font-12">Date of birth</label>
						<input type="date" class="form-control form-control-sm" id="dob" name="dob" placeholder="..." value="<?php echo date('Y-m-d', strtotime($lgu_constituent->dob)); ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="birthplace" class="font-12">Birthplace</label>
						<input type="text" class="form-control form-control-sm" id="birthplace" name="birthplace" placeholder="..." value="<?php echo $lgu_constituent->birthplace; ?>">
					</div>
					<div class="col-3 mt-2">
						<label for="citizenship" class="font-12">Citizenship</label>
						<input type="text" class="form-control form-control-sm" id="citizenship" name="citizenship" placeholder="..." value="<?php echo $lgu_constituent->citizenship; ?>">
					</div>
					
					<div class="col-3 mt-2 pl-0 rel-cont">
						<label for="civil_status" class="font-12">Civil Status</label>
						<select class="custom-select custom-select-sm" id="civil_status" name="civil_status">
						  <option selected hidden value="">-SELECT-</option>
						  <option value="Single" <?php echo $lgu_constituent->civil_status == 'Single'; ?>>Single</option>
						  <option value="Married" <?php echo $lgu_constituent->civil_status == 'Married'; ?>>Married</option>
						  <option value="Divorced" <?php echo $lgu_constituent->civil_status == 'Divorced'; ?>>Divorced</option>
						  <option value="Widowed" <?php echo $lgu_constituent->civil_status == 'Widowed'; ?>>Widowed</option>
						</select>
					</div>
				
					<div class="col-3 mt-2 pl-0">
						<label for="ofc_address" class="font-12">Office Address</label>
						<input type="text" class="form-control form-control-sm" id="ofc_address" name="ofc_address" placeholder="..." value="<?php echo $lgu_constituent->ofc_address; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="ofc_contact " class="font-12">Office Contact</label>
						<input type="text" class="form-control form-control-sm" id="ofc_contact " name="ofc_contact" placeholder="..." value="<?php echo $lgu_constituent->ofc_contact; ?>">
					</div>
					
					<div class="col-3 mt-2">
						<label for="house_type" class="font-12">House Type</label>
						<select class="custom-select custom-select-sm" id="house_type" name="house_type">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($resdntl as $row): ?>
						  	<option value="<?php echo $row->residential_id; ?>" <?php echo $lgu_constituent->house_type	== $row->residential_id ? 'selected' : ''; ?>><?php echo $row->residential_type; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					

					<!-- heading -->
					<div class="col-12 mb-3 mt-4">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-address-card"></i> Contact Details</h6>
						</div>
					</div>
					<!--  -->

					<div class="col-3 mt-2">
						<label for="residential_address" class="font-12">Residential Address</label>
						<input type="text" class="form-control form-control-sm" id="residential_address" name="residential_address" placeholder="..." value="<?php echo $lgu_constituent->residential_address; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="email " class="font-12">Email</label>
						<input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="..." value="<?php echo $lgu_constituent->email; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="tel_no" class="font-12">Tel No.</label>
						<input type="text" class="form-control form-control-sm" id="tel_no" name="tel_no" placeholder="..." value="<?php echo $lgu_constituent->tel_no; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="mobile" class="font-12">Mobile No.</label>
						<input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="..." value="<?php echo $lgu_constituent->mobile; ?>">
					</div>
					<?php $gcCnt=0; ?>
					<?php if (!empty($government_card)): ?>
						<?php foreach ($government_card as $gc): ?>
							<div class="col-12"></div>
							<div class="col-3 mt-2 govt-name-cont">
								<label for="govt_name" class="font-12">Govertment ID's/Docs</label>
								<select class="custom-select custom-select-sm" id="govt_name" name="govt_name[]">
								  <option selected value="">-None-</option>
									<?php foreach ($gov_ids as $row): ?>
										<option value="<?php echo $row->card_type_id; ?>" <?php echo $row->card_type_id == $gc->id_name ? 'selected' : ''; ?>><?php echo $row->card_name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-3 mt-2 pl-0">
								<label for="govt_id" class="font-12">Gov't ID #</label>
								<input type="text" class="form-control form-control-sm" id="govt_id" name="govt_id[]" placeholder="..." value="<?php echo $gc->id_number; ?>">
							</div>
							<div class="col-1 mt-4 pt-3 pl-0" id="addgovt-sect">
								<?php if ($gcCnt>0): ?>
									<button type="button" class="btn btn-warning btn-sm font-12" id="ded-govt-field"><i class="fas fa-minus"></i></button>
								<?php endif; ?>
								<button type="button" class="btn btn-success btn-sm" id="add-govt-field"><i class="fas fa-plus"></i></button>
							</div>
							<?php $gcCnt++; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<div class="col-12"></div>
							<div class="col-3 mt-2 govt-name-cont">
								<label for="govt_name" class="font-12">Govertment ID's/Docs</label>
								<select class="custom-select custom-select-sm" id="govt_name" name="govt_name[]">
								  <option selected value="">-None-</option>
									<?php foreach ($gov_ids as $row): ?>
										<option value="<?php echo $row->card_type_id; ?>"><?php echo $row->card_name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-3 mt-2 pl-0">
								<label for="govt_id" class="font-12">Gov't ID #</label>
								<input type="text" class="form-control form-control-sm" id="govt_id" name="govt_id[]" placeholder="..." value="">
							</div>
							<div class="col-1 mt-4 pt-3 pl-0" id="addgovt-sect">
								<button type="button" class="btn btn-success btn-sm" id="add-govt-field"><i class="fas fa-plus"></i></button>
							</div>
					<?php endif; ?>
					


					<!-- heading -->
					<div class="col-12 mb-3 mt-4">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-child"></i> Family Background</h6>
						</div>
					</div>
					<!-- end -->
					<div class="col-4 mt-2">
						<label for="spouce_name" class="font-12">Spouce Name</label>
						<input type="text" class="form-control form-control-sm" id="spouce_name" name="spouce_name" placeholder="..." value="<?php echo $lgu_constituent->spouce_name; ?>">
					</div>
					<div class="col-8 mt-2 pl-0">
						<label for="spouce_birth_place" class="font-12">Birth Place</label>
						<input type="text" class="form-control form-control-sm" id="spouce_birth_place" name="spouce_birth_place" placeholder="..." value="<?php echo $lgu_constituent->spouce_birth_place; ?>">
					</div>
					<div class="col-4 mt-2">
						<label for="fathers_name" class="font-12">Father's Name</label>
						<input type="text" class="form-control form-control-sm" id="fathers_name" name="fathers_name" placeholder="..." value="<?php echo $lgu_constituent->fathers_name; ?>">
					</div>
					<div class="col-8 mt-2 pl-0">
						<label for="fathers_birth_place" class="font-12">Birth Place</label>
						<input type="text" class="form-control form-control-sm" id="fathers_birth_place" name="fathers_birth_place" placeholder="..." value="<?php echo $lgu_constituent->fathers_birth_place; ?>">
					</div>
					<div class="col-4 mt-2">
						<label for="mothers_name" class="font-12">Mother's Name</label>
						<input type="text" class="form-control form-control-sm" id="mothers_name" name="mothers_name" placeholder="..." value="<?php echo $lgu_constituent->mothers_name; ?>">
					</div>
					<div class="col-8 mt-2 pl-0">
						<label for="mothers_birth_place" class="font-12">Birth Place</label>
						<input type="text" class="form-control form-control-sm" id="mothers_birth_place" name="mothers_birth_place" placeholder="..." value="<?php echo $lgu_constituent->mothers_birth_place; ?>">
					</div>
					<?php $chldrn=0; ?>
					<?php if (!empty($children)): ?>
						<?php foreach ($children as $row): ?>
							<div class="col-4 mt-2">
								<label for="children_name" class="font-12">Child's Name</label>
								<input type="text" class="form-control form-control-sm" id="children_name" name="children_name[]" placeholder="..." value="<?php echo $row->name; ?>">
							</div>
							<div class="col-7 mt-2 pl-0">
								<label for="children_birth_place" class="font-12">Birth Place</label>
								<input type="text" class="form-control form-control-sm" id="children_birth_place" name="children_birth_place[]" placeholder="..." value="<?php echo $row->birthplace; ?>">
							</div>
							<div class="col-1 mt-4 pt-3 pl-0" id="children-sect">
								<?php if ($chldrn>0): ?>
									<button type="button" class="btn btn-warning btn-sm font-12" id="ded-children-field"><i class="fas fa-minus"></i></button>
								<?php endif; ?>
								<button type="button" class="btn btn-success btn-sm" id="add-children-field"><i class="fas fa-plus"></i></button>
							</div>
							<?php $chldrn++; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<div class="col-4 mt-2">
							<label for="children_name" class="font-12">Child's Name</label>
							<input type="text" class="form-control form-control-sm" id="children_name" name="children_name[]" placeholder="..." value="">
						</div>
						<div class="col-7 mt-2 pl-0">
							<label for="children_birth_place" class="font-12">Birth Place</label>
							<input type="text" class="form-control form-control-sm" id="children_birth_place" name="children_birth_place[]" placeholder="..." value="">
						</div>
						<div class="col-1 mt-4 pt-3 pl-0" id="children-sect">
							<button type="button" class="btn btn-success btn-sm" id="add-children-field"><i class="fas fa-plus"></i></button>
						</div>
					<?php endif; ?>

					<!-- heading -->
					<div class="col-12 mb-3 mt-4">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-child"></i> Other Information</h6>
						</div>
					</div>
					<!-- end -->

					<div class="col-3 mt-2">
						<label for="highest_educ_attmnt" class="font-12">Highest Educational Attainment</label>
						<select class="custom-select custom-select-sm" id="highest_educ_attmnt" name="highest_educ_attmnt">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($educ as $row): ?>
						  	<option value="<?php echo $row->education_id; ?>" <?php echo $row->education_id == $lgu_constituent->highest_educ_attmnt ? 'selected' : ''; ?>><?php echo $row->education_name; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="occupation" class="font-12">Occupation</label>
						<input type="text" class="form-control form-control-sm" id="occupation" name="occupation" placeholder="..." value="<?php echo $lgu_constituent->occupation; ?>">
					</div>
					<div class="col-3 mt-2 pl-0 rel-cont">
						<label for="religion" class="font-12">Religion</label>
						<select class="custom-select custom-select-sm" id="religion" name="religion">
						  <option selected hidden value="">-SELECT-</option>
						  <option value="1" <?php echo $lgu_constituent->religion == '1' ? 'selected' : ''; ?>>Catholic</option>
						  <option value="2" <?php echo $lgu_constituent->religion == '2' ? 'selected' : ''; ?>>Muslim</option>
						  <option value="3" <?php echo $lgu_constituent->religion == '3' ? 'selected' : ''; ?>>Others</option>
						</select>
						<?php if ($lgu_constituent->religion == '3'): ?>
					  	<input type="text" class="form-control form-control-sm mt-2" id="religion_desc" name="religion_desc" placeholder="Write here.." value="<?php echo $lgu_constituent->religion_desc; ?>">
					  <?php endif; ?>
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="height" class="font-12">Height</label>
						<input type="text" class="form-control form-control-sm" id="height" name="height" placeholder="..." value="<?php echo $lgu_constituent->height; ?>">
					</div>
					<div class="col-3 mt-2">
						<label for="weight" class="font-12">Weight</label>
						<input type="text" class="form-control form-control-sm" id="weight" name="weight" placeholder="..." value="<?php echo $lgu_constituent->weight; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="identifying_marks" class="font-12">Identifying Marks</label>
						<input type="text" class="form-control form-control-sm" id="identifying_marks" name="identifying_marks" placeholder="..." value="<?php echo $lgu_constituent->identifying_marks; ?>">
					</div>
					<!--  -->


					

			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
			<button type="submit" class="btn btn-default btn-sm rounded-0 border float-right"><i class="fas fa-save"></i> Save</button>
		</form>

	</div>
</div>