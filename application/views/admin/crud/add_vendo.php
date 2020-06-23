<div class="cont-add-member row none">
	<div class="col-4">
		<a href="javascript:void(0);" class="float-right pr-2 pb-2" onclick="window.location.reload();" id="" data-link="" data-badge-head="VENDO"
   								data-cls="cont-tbl-constituent" data-placement="top" data-toggle="tooltip" title="Back to List"><i class="fas fa-times"></i></a>
	</div>
	<div class="col-12"></div>
	<div class="col-4">
		<form id="frm-add-vendo">
			<div class="row">
					<div class="col-12">
						<label for="month" class="font-12 cst-lbl">Client</label>
						<select class="custom-select font-12" name="lgu_constituent_id">
							<?php foreach ($member_list as $row) { ?>
								<option value="<?php echo $row->lgu_constituent_id; ?>"><?php echo strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name); ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12">
						<label for="date_applied" class="font-12 cst-lbl">Date</label>
						<input type="date" class="form-control form-control-sm font-12" id="date_applied" name="date_applied">
					</div>
					<div class="col-12">
						<label for="amount" class="font-12 cst-lbl">Amount Collected</label>
						<input type="text" class="form-control form-control-sm font-12 isNum" id="amount" name="amount">
					</div>
					<div class="col-12">
						<label for="remarks" class="font-12 cst-lbl">Remarks</label>
						<input type="text" class="form-control form-control-sm font-12" id="remarks" name="remarks">
					</div>
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
			<input type="hidden" name="has_update">
			<button type="submit" class="btn btn-default btn-sm rounded-0 border float-right"><i class="fas fa-save"></i> Save</button>
		</form>

	</div>
</div>