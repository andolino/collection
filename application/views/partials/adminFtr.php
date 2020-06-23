</div><!-- wrapper -->
<script type="text/javascript">
	var baseURL = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/j-validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/j-additional-methods.js"></script>
<!-- SweetAlert -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/swal.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
<!-- Popper.JS -->
<script 
	src="<?php echo base_url(); ?>assets/js/app.js?random=<?php echo mt_rand(); ?>"></script>
<script 
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- Bootstrap JS -->
<script 
	src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" ></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        	
        });
    });
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- spinner -->
<div class="spinner-cont">
	<div class="lds-roller">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
</div>
<!-- end spinner -->
</body>
</html>