<!-- Sidebar  -->
<nav id="sidebar">
  <div class="sidebar-header">
    <div class="row">
      <div class="col-7"><h3 style="line-height: 1.8">MONITORING SALES</h3></div>
    </div>
    
  </div>

  <ul class="list-unstyled components">
      <p class="text-center"> WELCOME <?php echo strtoupper($this->session->username); ?></p>
      <li>
        <a href="<?php echo base_url(); ?>" class="font-12"><i class="fas fa-users"></i> ABOUT US</a>
      </li>
      <li>
        <a href="<?php echo base_url(); ?>constituent-list"><i class="fas fa-money-check"></i> CONSTITUENT</a>
      </li>
      <li>
        <a href="<?php echo base_url(); ?>monthly-bills"><i class="fas fa-money-check"></i> MONTHLY BILLS</a>
      </li>
      <li class="">
        <a href="<?php echo base_url(); ?>internet-sales"><i class="fas fa-money-check"></i> INTERNET SALES</a>
      </li>
      <li class="">
        <a href="<?php echo base_url(); ?>vendo"><i class="fas fa-money-check"></i> VENDO COLLECTED SALES</a>
      </li>
      <!-- <li class="active">
          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Manage Information</a>
          <ul class="collapse list-unstyled" id="homeSubmenu">
              <li>
                  <a href="#">Personal Information</a>
              </li>
              <li>
                  <a href="#">Marriage Information</a>
              </li>
              <li>
                  <a href="#">Children Information</a>
              </li>
          </ul>
      </li> -->
  </ul>

</nav>
