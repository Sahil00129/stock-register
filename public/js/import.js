
$(document).ready(function (e) {

  var baseUrl = "{{url('/')}}";
  $('#allSites').DataTable({});
  manageTable = $('#userStable').DataTable({
    ajax: {
      url: '/user/get-list',
  },
    'order': [],

    dom: 'Bfrtip',

    columns: [
      /*{data:'serial_no', name: 'serial_no'},*/
      {data:'name', name: 'name', orderable: false, searchable: false},
      {data:'email', name: 'email'},
      {data:'roles', name: 'roles'},
      {data:'permissions', name: 'permissions'},
      {data:'action', name: 'action'}

  ],

    buttons: [
            'copyHtml5',
            'csvHtml5',  
        ],

        ordering: false,
    
  });

 
  $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  $('#kt_modal_upload_csv').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  var myfile = jQuery('#myCsv').val();
  var itype = jQuery('#itype').val();
  if (!itype) {
    swal("Error!", "Please select import type", "error");
    return false;
  }
  if (!myfile) {
      swal("Error!", "No file, please upload an import file", "error");
      return false;
    }
  $.ajax({
      type:'POST',
      url: "/import",
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      beforeSend: function(){
        $(".indicator-progress").show();
        $(".indicator-label").hide();
        
       },
      success: (data) => {
        $(".indicator-progress").hide();
        $(".indicator-label").show();
      //this.reset();
      //console.log(data.ignoredItems);
      //console.log(data.ignoredcount);
      if(data.success === true) { 
         if(data.ignoredcount > 0) {
          $(".ignored").show();
          document.getElementById("ignoredItems").innerHTML = data.ignoredItems.join();
          swal("success!", data.ignoredcount + " ignored, Rest Items has been imported successfully", "success");
         } 
         else{
          swal("success!", "File has been imported successfully", "success");
        }
      }
      else{
      swal("error!", data.messages, "error");
      }
    }
  });
  });

  // *******************************************  List datatable ****************************************//

  $('#itemList').DataTable({
    dom: 'Bfrtip',
    "pageLength": 20,
    buttons: ['csvHtml5'],
    ordering: false,
    initComplete: function () {
      this.api().columns().every(function () {
        var column = this;
        var select = $('<select class="cfilter"><option value="">--Select--</option></select>').appendTo($("#filters").find("th").eq(column.index())).on('change', function () {
          var val = $.fn.dataTable.util.escapeRegex($(this).val());
          column.search(val ? '^' + val + '$' : '', true, false).draw();
        });
        console.log(select);
        column.data().unique().sort().each(function (d, j) {
          $(select).append('<option value="' + d + '">' + d + '</option>')
        });
      });
    }
  });

   // ******************************************* Sale Data ****************************************//

  $('#salesData').DataTable({
    processing: true,
    serverSide: true,
    ajax: "/sales-data-request",
    buttons: ['csvHtml5'],
    columns: [
        { "data": "item_name" },
        { "data": "bill_no" },
        { "data": "bill_date" },
        { "data": "sales_to_customer_name" },
        { "data": "quantity_in_kgltr" },
        { "data": "document_type" },
    ],
    initComplete: function () {
      this.api().columns().every(function () {
        var column = this;
        var select = $('<select class="cfilter"><option value="">--Select--</option></select>').appendTo($("#filters").find("th").eq(column.index())).on('change', function () {
          var val = $.fn.dataTable.util.escapeRegex($(this).val());
          column.search(val ? '^' + val + '$' : '', true, false).draw();
        });
        console.log(select);
        column.data().unique().sort().each(function (d, j) {
          $(select).append('<option value="' + d + '">' + d + '</option>')
        });
      });
    }
}); 

   // ******************************************* Purchase DataTable ****************************************//

$('#purchaseData').DataTable({
  processing: true,
  serverSide: true,
  ajax: "/purhase-data-request",
  buttons: ['csvHtml5'],
  columns: [
      { "data": "item_name" },
      { "data": "bill_date" },
      { "data": "vendor_name" },
      { "data": "batch_number" },
      { "data": "vendor_invoice_no" },
      { "data": "vendor_invoice_date" },
      { "data": "quantity_in_kgltr" },
      { "data": "document_type" },
  ],
  initComplete: function () {
    this.api().columns().every(function () {
      var column = this;
      var select = $('<select class="cfilter"><option value="">--Select--</option></select>').appendTo($("#filters").find("th").eq(column.index())).on('change', function () {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', true, false).draw();
      });
      console.log(select);
      column.data().unique().sort().each(function (d, j) {
        $(select).append('<option value="' + d + '">' + d + '</option>')
      });
    });
  }
}); 

  // *******************************************  Filter Sale for PDF ****************************************//

  $('#igroup').on('change', function() {
    $('#ipacking').empty(); 
   var selected = this.value;
   var fd = new FormData();
   fd.append('group', selected);
    $.ajax({
      type:'POST',
      url: "/filter-items",
      data: fd,
      cache:false,
      contentType: false,
      processData: false,
      success: (data) => {
      console.log(data);
      if(data.success === true) {
        //alert(data.messages);
       var sObj = data.messages;
       $.each(data.messages, function (index, value) {
        // APPEND OR INSERT DATA TO SELECT ELEMENT.
        
        $('#ipacking').append('<option value="' + value.pack + '">' + value.pack + '</option>');
        });
      }
      else{
      swal("error!", data.messages, "error");
      }
    }
  });
  });

  /*$('#filterSale').submit(function(e) {
    e.preventDefault();
     //return false;
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "/filter",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        xhrFields: { 
          responseType: 'blob' 
        }, 
        success: function(response){ 
          var blob = new Blob([response]); 
          var link = document.createElement('a'); 
          link.href = window.URL.createObjectURL(blob); 
          alert(link.href);
          link.download = "Sample.pdf"; 
          link.click(); 
      }, 
      error: function(blob){ 
          console.log(blob); 
      } 
    });
    });*/



});

