$(function() {
  var oTable = $('#dataTable').DataTable({
    "iDisplayLength": -1,
    "sPaginationType": "full_numbers",

  });




  $("#datepicker_from").datepicker({
    showOn: "button",
    buttonImage: "images/calendar.gif",
    buttonImageOnly: false,
    "onSelect": function(date) {
      minDateFilter = new Date(date).getTime();
      oTable.fnDraw();
    }
  }).keyup(function() {
    minDateFilter = new Date(this.value).getTime();
    oTable.fnDraw();
  });

  

});

// Date range filter
minDateFilter = '';
maxDateFilter = '';

$.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
  if (typeof aData._date == 'undefined') {
    aData._date = new Date(aData[3]).getTime();
  }

  if (minDateFilter && !isNaN(minDateFilter)) {
    if (aData._date < minDateFilter) {
      return false;
    }
  }

  if (maxDateFilter && !isNaN(maxDateFilter)) {
    if (aData._date > maxDateFilter) {
      return false;
    }
  }

  return true;
});