<div class="cont-edit-member row none">
	<div class="col-6">
		<a href="javascript:void(0);" class="float-right pr-2 pb-2" onclick="window.location.reload();" id="" data-link="" data-badge-head="INTERNET SALES"
   								data-cls="cont-tbl-constituent" data-placement="top" data-toggle="tooltip" title="Back to List"><i class="fas fa-times"></i></a>
	</div>
	<div class="col-12"></div>
	<div class="col-6">
		<form id="frm-add-internet-sales">
			<div class="row">
					<div class="col-12">
						<label for="date_applied" class="font-12 cst-lbl">Date</label>
						<input type="date" class="form-control form-control-sm font-12" id="date_applied" name="date_applied" value="<?php echo !empty($data) ? $data->date_applied : ''; ?>">
					</div>
					<div class="col-12">
						<label for="amount" class="font-12 cst-lbl">Amount Collected</label>
						<input type="text" class="form-control form-control-sm font-12 isNum" id="amount" name="amount" value="<?php echo !empty($data) ? number_format($data->amount, 2) : ''; ?>">
					</div>
					<div class="col-12">
						<label for="remarks" class="font-12 cst-lbl">Remarks</label>
						<input type="text" class="form-control form-control-sm font-12" id="remarks" name="remarks" value="<?php echo !empty($data) ? $data->remarks : ''; ?>">
					</div>
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
			<input type="hidden" name="has_update" value="<?php echo !empty($data) ? $data->comp_shop_id : ''; ?>">
			<button type="submit" class="btn btn-default btn-sm rounded-0 border float-right"><i class="fas fa-save"></i> Save</button>
		</form>

	</div>
</div>