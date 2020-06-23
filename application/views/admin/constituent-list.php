
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
      <button type="button" class="btn btn-default btn-md rounded-0" id="loadPage" data-badge-head="ADD CONSTITUENT" data-link="add-constituent" data-ind="" data-cls="cont-add-member"><i class="fas fa-user-plus"></i> Add Constituent</button>
    </div>
    <div class="col pl-0">
      <button type="button" class="btn btn-default btn-md rounded-0" id="view_id_selected" disabled><i class="fas fa-print"></i> View ID Selected</button>
    </div>
  </div>
</div>
<div class="navbar bg-light custom-container none">
  <table class="table font-12 w-100" id="tbl-lgu-constituent-list">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">FULL NAME</th>
        <th scope="col">ADDRESS</th>
        <th scope="col">AGE</th>
        <th scope="col">DATE OF BIRTH</th>
        <th scope="col">MEMBER TYPE</th>
        <th scope="col">ACTION</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
<div class="line"></div>
    
</div>