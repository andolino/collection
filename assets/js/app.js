$(window).on('load', function(){
  //remove loading
  animateSingleIn('.custom-container', 'fadeInUp');
  animateSingleOut('.spinner-cont', 'fadeOut');

    
});

//datatable var array
var tbl_lgu_constituent = [];
$(document).ready(function() {
  //init plugin
  // $("body").tooltip({ selector: '[data-toggle=tooltip]' });

  var dd = new Date();
  var sd = new Date(dd.getFullYear(), dd.getMonth(), 1);
  var ed = new Date(dd.getFullYear(), dd.getMonth() + 1, 0);

  $('.filter_vendo').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Clear'
    }
  }, function(start, end){
    $('.filter_vendo').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); 
    $('input[name="sd"]').val(formatDate(start));
    $('input[name="ed"]').val(formatDate(end));
    initVendoDataTables(formatDate(start), formatDate(end));

    $.ajax({
      type: "POST",
      url: "get-vendo-hidden",
      data: {
        'lgu_id' : $('#members_name').val(),
        'sd'     : formatDate(start), 
        'ed'     : formatDate(end)
      },
      success: function (res) {
        $('.export-excel').html(res);
      }
    });
  });
  
  $('.filter_monthly_bills').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Clear'
    }
  }, function(start, end){
    $('.filter_monthly_bills').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); 
    $('input[name="sd"]').val(formatDate(start));
    $('input[name="ed"]').val(formatDate(end));
    initMonthlyBillsDataTables(formatDate(start), formatDate(end));

    $.ajax({
      type: "POST",
      url: "get-monthly-bill-hidden",
      data: {
        'lgu_id' : $('#members_name').val(),
        'sd'     : formatDate(start), 
        'ed'     : formatDate(end)
      },
      success: function (res) {
        $('.export-excel').html(res);
      }
    });
  });
  
  $('.filter_internet_sales').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Clear'
    }
  }, function(start, end){
    $('.filter_internet_sales').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); 
    $('input[name="sd"]').val(formatDate(start));
    $('input[name="ed"]').val(formatDate(end));
    initInternetSalesDataTables(formatDate(start), formatDate(end));

    $.ajax({
      type: "POST",
      url: "get-internet-sales-hidden",
      data: {
        'sd'     : formatDate(start), 
        'ed'     : formatDate(end)
      },
      success: function (res) {
        $('.export-excel').html(res);
      }
    });
  });

  $(document).on('click', '.print-filter-mb-excel', function () {
    exportF($(this), 'tbl-monthly-bills-excel', 'monthly_billing');
  });
  
  $(document).on('click', '.print-filter-v-excel', function () {
    exportF($(this), 'tbl-vendo-excel', 'vendo');
  });
  
  $(document).on('click', '.print-filter-is-excel', function () {
    exportF($(this), 'tbl-internet-sales-excel', 'internet_sales');
  });

  $(document).on('change', '#select-type', function (e) {
    if($(this).val() == "") {
      $('select[name="members_name"]').val('').trigger('change');
      $('.members_name').addClass('d-none');
      
      $('select[name="members_name_v"]').val('').trigger('change');
      $('.members_name_v').addClass('d-none');
    } else {
      $('.members_name').removeClass('d-none');
      $('#members_name').select2({
        dropdownCssClass: "font-12"
      });
      
      $('.members_name_v').removeClass('d-none');
      $('#members_name_v').select2({
        dropdownCssClass: "font-12"
      });
    }
  });

  $(document).on('change', 'select[name="members_name"]', function (e) {
    $('.filter_monthly_bills').html('<i class="fas fa-calendar"></i> FILTER DATE');
    initMonthlyBillsDataTables(formatDate(sd), formatDate(ed));

    $.ajax({
      type: "POST",
      url: "get-monthly-bill-hidden",
      data: {
        'lgu_id' : $('#members_name').val(),
        'sd'     : formatDate(sd), 
        'ed'     : formatDate(ed)
      },
      success: function (res) {
        $('.export-excel').html(res);
      }
    });
  });
  
  $(document).on('change', 'select[name="members_name_v"]', function (e) {
    $('.filter_vendo').html('<i class="fas fa-calendar"></i> FILTER DATE');
    initVendoDataTables(formatDate(sd), formatDate(ed));

    $.ajax({
      type: "POST",
      url: "get-vendo-hidden",
      data: {
        'lgu_id' : $('#members_name_v').val(),
        'sd'     : formatDate(sd), 
        'ed'     : formatDate(ed)
      },
      success: function (res) {
        $('.export-excel').html(res);
      }
    });
  });

  //load page
  $(document).on('click', '#loadPage', function(event) {
    var link          = $(this).attr('data-link');
    var d             = $(this).attr('data-ind');
    var dataBadgeHead = $(this).attr('data-badge-head');
    // $(this).tooltip('hide');
    $('.custom-container').html('');
    $.get(baseURL + link, { 'data' : d }, function(data, textStatus, xhr) {
      $('.custom-container').html(data);
      $( "div.picture-cont" )
      .mouseenter(function() {
        $('.upload-ctrl').removeClass('none');
      })
      .mouseleave(function() {
        $('.upload-ctrl').addClass('none');
      });
      $('#badge-heading').html(dataBadgeHead);
      $('select[name="lgu_constituent_id"]').select2({ 
                                                    width: '100%',
                                                    dropdownCssClass: "font-12"
                                               });

      animateSingleIn('.cont-add-member', 'fadeInUp');
      animateSingleIn('.cont-view-member', 'fadeInUp');
      animateSingleIn('.cont-edit-member', 'fadeInUp');

      animateSingleIn('.cont-tbl-constituent', 'fadeIn');
      initLguDataTables();
      initMonthlyBillsDataTables(formatDate(sd), formatDate(ed));
      initInternetSalesDataTables(formatDate(sd), formatDate(ed));
      initVendoDataTables(formatDate(sd), formatDate(ed));


    });    
  });

  //init lgu table list
  initLguDataTables();
  initMonthlyBillsDataTables(formatDate(sd), formatDate(ed));
  initInternetSalesDataTables(formatDate(sd), formatDate(ed));
  initVendoDataTables(formatDate(sd), formatDate(ed));

  //for numeric values input
  $(document).on("focusout", '.isNum', function(e){
    $(this).val(isNaN(parseFloat($(this).val().replace(',',''))) ? '0' : number_format($(this).val().replace(',', '')));
  });
  $(document).on("change, keyup", '.isNum', function(e){
    var currentInput = $(this).val();
    var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
    $(this).val(fixedInput);
  });



  //form submit
  $(document).on('submit', '#frm-add-constituent', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var frm = $(this).serialize(); 
    $.ajax({
      url      : 'save-constituent',
      type     : 'POST',
      data     : frm,
      dataType : 'JSON',
      success  : function(res) {
        // console.log(typeof res.length);
        console.log(res);

        if (typeof res.length === 'undefined') {
          $.each(res, function(index, el) {
            if ($('#'+index).parent('div').find('div.invalid-feedback').length == 0) {
              $('#'+index).parent('div').append('<div class="invalid-feedback">'+el+'</div>').show();
              $('#'+index).parent('div').find('div.invalid-feedback').show();
            } else {
              $('#'+index).parent('div').find('div.invalid-feedback').html(el).show();
            }
            $(document).on('change input', '#'+index, function(){
              $('#'+index).parent('div').find('div.invalid-feedback').hide();
            });
          });
        } else {
          Swal.fire(
            'Success!',
            'You successfully saved!',
            'success'
          );
          // $('#frm-add-constituent').trigger('reset');
        }
      }
    });
  });
  
  $(document).on('submit', '#frm-add-internet-sales', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var frm = $(this).serialize(); 
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['Hey!', 'Are you sure you want to save', 'warning'], 
      function(){
        $.ajax({
          url      : 'save-internet-sales',
          type     : 'POST',
          data     : frm,
          dataType : 'JSON',
          success  : function(res) {
            console.log(res);
            Swal.fire(
              res.param1,
              res.param2,
              res.param3
            );
            $('a[data-link="tbl-internet-sales"]').trigger('click');
          }
        });
    }, function(){
      console.log('Fail');
    });

    
  });
  
  $(document).on('submit', '#frm-add-monthly-bills', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var frm = $(this).serialize(); 
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['Hey!', 'Are you sure you want to save', 'warning'], 
      function(){
        $.ajax({
          url      : 'save-monthly-bills',
          type     : 'POST',
          data     : frm,
          dataType : 'JSON',
          success  : function(res) {
            console.log(res);
            Swal.fire(
              res.param1,
              res.param2,
              res.param3
            );
            $('a[data-link="tbl-monthly-bills"]').trigger('click');
          }
        });
    }, function(){
      console.log('Fail');
    });

    
  });
  
  $(document).on('submit', '#frm-add-vendo', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var frm = $(this).serialize(); 
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['Hey!', 'Are you sure you want to save', 'warning'], 
      function(){
        $.ajax({
          url      : 'save-vendo',
          type     : 'POST',
          data     : frm,
          dataType : 'JSON',
          success  : function(res) {
            console.log(res);
            Swal.fire(
              res.param1,
              res.param2,
              res.param3
            );
            $('a[data-link="tbl-vendo"]').trigger('click');
          }
        });
    }, function(){
      console.log('Fail');
    });

    
  });

  //custom
  $(document).on('click', '#chk-const-list-tbl-all', function(e) {
    var rows = tbl_lgu_constituent.rows({ 'search': 'applied' }).nodes();
    $('input[type="checkbox"]', rows).prop('checked', this.checked);
    if ($(this).is(':checked')) {
      $('#view_id_selected').removeAttr('disabled');
    } else {
      $('#view_id_selected').prop('disabled', true);
    }
  });

  $(document).on('click', '#chk-const-list-tbl', function(e) {
    var d = []; 
    $.each($('.chk-const-list-tbl'), function(i, el) {
      d[i]=$(el).is(':checked').toString();
    });
    if ($.inArray('true', d) !== -1) {
      $('#view_id_selected').removeAttr('disabled');
    } else {
      $('#view_id_selected').prop('disabled', true);
    }
  });

  $(document).on('click', '#generate-token', function(event) {
    event.preventDefault();
    $.ajax({
      url: 'generate-token',
      type: 'POST',
      dataType: 'JSON',
      success: function(res){
        $('input[name="token"]').val(res.token);
        $('input[name="secret-key"]').val(res.encrypt_key);
      }
    });
  });

  $(document).on('submit', '#frm-add-token-key', function(e) {
    e.preventDefault();
    var frm = $(this).serialize();
    $.ajax({
      url: 'save-token',
      type: 'POST',
      dataType: 'JSON',
      data: frm,
      success: function(res){
        Swal.fire(
          res.param1,
          res.param2,
          res.param3
        );
      }
    });

  });
  
  $(document).on('click', '#view_id_selected', function(e) {
    e.preventDefault();
    var _ids = [];
    $('input[name="chk-const-list-tbl[]"]:checked').each(function(i, el){
      _ids.push($(el).val());
    });
    $.ajax({
      url       : 'show-multiple-ids',
      type      : 'POST',
      dataType  : 'JSON',
      data      : {'ids' : _ids},
      success   : function(res){
        window.open(baseURL + 'show-mltple-const/' + res.ids);
      }
    });
    
  });
  

  $(document).on('change', 'input[name=upload-file-dp]', function(e) {
    e.preventDefault();

  });

  $(document).on('click', '#add-children-field', function(e) {
    e.preventDefault();
    var ht = '';
    ht += '<div class="col-4 mt-2">';
      ht += '<label for="children_name" class="font-12">Children\'s Name</label>';
      ht += '<input type="text" class="form-control form-control-sm" id="children_name" name="children_name[]" placeholder="...">';
    ht += '</div>';
    ht += '<div class="col-7 mt-2 pl-0">';
      ht += '<label for="children_birth_place" class="font-12">Birth Place</label>';
      ht += '<input type="text" class="form-control form-control-sm" id="children_birth_place" name="children_birth_place[]" placeholder="...">';
    ht += '</div>';
    ht += '<div class="col-1 mt-4 pt-3 pl-0" id="children-sect">';
      ht += '<button type="button" class="btn btn-warning btn-sm font-12" id="ded-children-field"><i class="fas fa-minus"></i></button> | ';
      ht += '<button type="button" class="btn btn-success btn-sm font-12" id="add-children-field"><i class="fas fa-plus"></i></button>';
    ht += '</div>';
    $(ht).insertAfter($(this).parent('div'));
  });

  $(document).on('click', '#add-govt-field', function(e) {
    e.preventDefault();
    var ht = '';
    ht += '<div class="col-12"></div>';
      ht += '<div class="col-3 mt-2 govt-name-cont">';
      ht += $('.govt-name-cont').html();
      ht += '</div>';
    ht += '<div class="col-3 mt-2 pl-0">';
      ht += '<label for="govt_id" class="font-12">Gov\'t ID #</label>';
      ht += '<input type="text" class="form-control form-control-sm" id="govt_id" name="govt_id[]" placeholder="...">';
    ht += '</div>';
    ht += '<div class="col-1 mt-4 pt-3 pl-0" id="addgovt-sect">';
      ht += '<button type="button" class="btn btn-warning btn-sm font-12" id="ded-govt-field"><i class="fas fa-minus"></i></button> | ';
      ht += '<button type="button" class="btn btn-success btn-sm font-12" id="add-govt-field"><i class="fas fa-plus"></i></button>';
    ht += '</div>';
    $(ht).insertAfter($(this).parent('div'));
  });

  $(document).on('click', '#ded-children-field', function(e) {
    e.preventDefault();
    $(this).parent('div#children-sect').prev().remove();
    $(this).parent('div#children-sect').prev().remove();
    $(this).parent('div#children-sect').remove();
  });

  $(document).on('click', '#ded-govt-field', function(e) {
    e.preventDefault();
    $(this).parent('div#addgovt-sect').prev().remove();
    $(this).parent('div#addgovt-sect').prev().remove();
    $(this).parent('div#addgovt-sect').prev().remove();
    $(this).parent('div#addgovt-sect').remove();
  });

  $(document).on('click', 'input[name="social_status[]"]', function(e) {
    var val = $(this).val();
    if ($(this).is(':checked')) {
      // if ($(this).val() == 1) {
        $('.social_status'+val).append('<input type="text" class="form-control form-control-sm mt-2" id="pwd_id" name="pwd_id[]" placeholder="ID #">');
      // }
    } else {
      // if ($(this).val() == 1) {
        $('.social_status'+val).find('#pwd_id').remove();
        $('.social_status'+val).find('div.invalid-feedback').remove();
      // }
    }
  });

  $(document).on('change', 'select[name="religion"]', function(e) {
    e.preventDefault();
    if ($(this).val() == 3) {
      $('.rel-cont').append('<input type="text" class="form-control form-control-sm mt-2" id="religion_desc" name="religion_desc" placeholder="Write here..">');
    } else {
      $('#religion_desc').remove();  
    }
  });

  $(document).on('change', '#upload-file-dp', function() {
    $('.spinner-cont').removeClass('none');
    $('#frm-upload-dp').trigger('submit');
  });

  $(document).on('submit', '#frm-upload-dp', function(e) {
    e.preventDefault();
    var frm = new FormData(this);
    frm.append('lgu-cons-id', $(this).find('input[type="hidden"]').val());
    
    $.ajax({
      url:'upload-dp',
      type:"post",
      data: frm,
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      dataType: 'json',
      success: function(data){
        if (data.success) {
          Swal.fire(
            'Success!',
            'Picture Successfully Updated!',
            'success'
          );
        } else {
          Swal.fire(
            'Oopps!',
            'Looks like there was an error encountered!',
            'warning'
          );
        }
        // alert("Upload Image Successful.");
        $('#lgu-captured-image').attr('src', baseURL + 'assets/image/uploads/' + data.file_name);
        animateSingleOut('.spinner-cont', 'fadeOut');
      }
    });
  });

  $(document).on('click', '#remove-lgu-const-list', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['Hey!', 'Are you sure you want to delete this constituent?', 'warning'], 
      function(){
      $.post('delete-constituent', {'id': id}, function(data, textStatus, xhr) {
        Swal.fire(
          'Alright!',
          'Successfully Deleted!',
          'success'
        );
        tbl_lgu_constituent.ajax.reload();
      });
      
    }, function(){
      console.log('Fail');
    });
  });


});


/* FUNCTIONS */
// animate single element in
function animateSingleIn(element, animation, focus = null) {
  $(element).addClass('animated ' + animation).removeClass('none');
  setTimeout(function() {
      $(element).removeClass('animated ' + animation);
      focus != null ? $(focus).focus() : null;
  }, 1000);
}

// animate single element out
function animateSingleOut(element, animation) {
  $(element).addClass('animated ' + animation);
  setTimeout(function() {
      $(element).removeClass('animated ' + animation).addClass('none');
  }, 1000);
}

function doUploadDb(){
  $('input[name=upload-file-dp]').trigger('click');
}



function customSwal(confrmBtn, canclBtn, confrmTxt, canclTxt, headingArr=array(), funCalback, failCalback){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: confrmBtn,
      cancelButton: canclBtn
    },
    buttonsStyling: false
  });

  swalWithBootstrapButtons.fire({
    title             : headingArr[0],
    text              : headingArr[1],
    icon              : headingArr[2],
    showCancelButton  : true,
    confirmButtonText : confrmTxt,
    cancelButtonText  : canclTxt,
    reverseButtons    : true
  }).then((result) => {
    if (result.value) {
      funCalback();
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      failCalback();
    }
  });
}


//init datatables =====================================================>
function initLguDataTables(){
  var myObjKeyLguConst = {};
  tbl_lgu_constituent  = $("#tbl-lgu-constituent-list").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6] 
      }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-lgu-constituent',
        "type"                 : 'POST',
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initInternetSalesDataTables(sd, ed){
  var myObjKeyLguConst = {};
  $('#tbl-internet-sales').DataTable().clear().destroy();
  tbl_lgu_constituent  = $("#tbl-internet-sales").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2] 
      }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-internet-sales',
        "type"                 : 'POST',
        "data"                 : {
          "sd"   : sd,
          "ed"   : ed
        }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initVendoDataTables(sd, ed){
  var myObjKeyLguConst = {};
  $('#tbl-vendo').DataTable().clear().destroy();
  tbl_lgu_constituent  = $("#tbl-vendo").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3] 
      }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-vendo',
        "type"                 : 'POST',
        "data"                 : {
          "sd"   : sd,
          "ed"   : ed,
          "lgu_id" : $('select[name="members_name_v"]').val()
        }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initMonthlyBillsDataTables(sd, ed){
  var myObjKeyLguConst = {};
  $('#tbl-monthly-bills').DataTable().clear().destroy();
  tbl_lgu_constituent  = $("#tbl-monthly-bills").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3] 
      }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-monthly-bills',
        "type"                 : 'POST',
        "data"                 : {
          "sd"   : sd,
          "ed"   : ed,
          "lgu_id" : $('select[name="members_name"]').val()
        }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}
  //init datatables END =====================================================>
// format numbers to currency format
function number_format(amount) {
  var formatted_amount = parseFloat(amount)
          .toFixed(2)
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return formatted_amount;
}

function formatDate(date) {
  var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();
  if (month.length < 2) 
      month = '0' + month;
  if (day.length < 2) 
      day = '0' + day;
  return [year, month, day].join('-');
}

function exportF(elem, tbl, filename) {
  var table = document.getElementById(tbl);
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem[0].setAttribute("href", url);
  elem[0].setAttribute("download", filename + ".xls"); // Choose the file name
  return false;
}