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
					<div class="col-3">
						<label for="member_type" class="font-12">Member Type</label>
						<select class="custom-select custom-select-sm" id="member_type" name="member_type">
							<option selected hidden value="">-SELECT-</option>
							<option value="0" <?php echo $lgu_constituent->member_type == 0 ? 'selected' : ''; ?>>Member</option>
							<option value="1" <?php echo $lgu_constituent->member_type == 1 ? 'selected' : ''; ?>>Vendo</option>
						</select>
					</div>
					<div class="col-3 pl-0">
						<label for="transaction_date" class="font-12">Transaction Date</label>
						<input type="date" class="form-control form-control-sm" id="transaction_date" name="transaction_date" placeholder="..." value="<?php echo $lgu_constituent->transaction_date; ?>">
					</div>
					<div class="col-3">
						<label for="last_name" class="font-12">Last Name</label>
						<input type="text" class="form-control form-control-sm" id="last_name" name="last_name" placeholder="..." value="<?php echo $lgu_constituent->last_name; ?>">
					</div>
					<div class="col-3 pl-0">
						<label for="first_name" class="font-12">First Name</label>
						<input type="text" class="form-control form-control-sm" id="first_name" name="first_name" placeholder="..." value="<?php echo $lgu_constituent->first_name; ?>">
					</div>
					<div class="col-3 mt-2">
						<label for="middle_name" class="font-12">Middle Name</label>
						<input type="text" class="form-control form-control-sm" id="middle_name" name="middle_name" placeholder="..." value="<?php echo $lgu_constituent->middle_name; ?>">
					</div>
					<div class="col-3 pl-0 mt-2">
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
					<div class="col-3 mt-2">
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
					<div class="col-3 mt-2 pl-0">
						<label for="residential_address" class="font-12">Residential Address</label>
						<input type="text" class="form-control form-control-sm" id="residential_address" name="residential_address" value="<?php echo $lgu_constituent->residential_address; ?>" placeholder="...">
					</div>
					<div class="col-3 mt-2 rel-cont">
						<label for="civil_status" class="font-12">Civil Status</label>
						<select class="custom-select custom-select-sm" id="civil_status" name="civil_status">
						  <option selected hidden value="">-SELECT-</option>
						  <option value="Single" <?php echo $lgu_constituent->civil_status == 'Single'; ?>>Single</option>
						  <option value="Married" <?php echo $lgu_constituent->civil_status == 'Married'; ?>>Married</option>
						  <option value="Divorced" <?php echo $lgu_constituent->civil_status == 'Divorced'; ?>>Divorced</option>
						  <option value="Widowed" <?php echo $lgu_constituent->civil_status == 'Widowed'; ?>>Widowed</option>
						</select>
					</div>
				
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
			<button type="submit" class="btn btn-default btn-sm rounded-0 border float-right"><i class="fas fa-save"></i> Save</button>
		</form>

	</div>
</div>