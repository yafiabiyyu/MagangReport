$(document).ready(function () {
  var table = $('#dataTable').DataTable();

  // Event listener to the two range filtering inputs to redraw on input
  $('#dateFrom, #dateTo').change(function () {
      table.draw();
      
      
  });
});

// $.fn.dataTable.ext.search.push(
//   function (settings, data, dataIndex) {
//       var dateFrom = moment(document.getElementById("dateFrom").value).format('MM/DD/YYYY');
//       var dateTo = moment(document.getElementById("dateTo").value).format('MM/DD/YYYY');
//       var startDate = data[3];
//       if (dateFrom == null && dateTo == null) {return false;}
//       if (dateFrom == null && startDate <= dateTo) {return true;}
//       if (dateTo == null && startDate >= dateFrom) {return true;}
//       if (startDate <= dateTo && startDate >= dateFrom) {return true;}
//       return false;
//   }
// );

// $.fn.dataTableExt.afnFiltering.push(
//   function( settings, data, dataIndex ) {
//       var min  = $('#dateFrom').val();
//       var max  = $('#dateTo').val();
//       var createdAt = data[3] || 0; // Our date column in the table
//       //createdAt=createdAt.split(" ");
//       var startDate   = new Date(min).();
//       var endDate     = moment(max).format("DD/MM/YYYY");
//       var diffDate = moment(createdAt).format("DD/MM/YYYY");
//       console.log(startDate);
//       if (
//         (min == "" || max == "") ||
//         (diffDate.isBetween(startDate, endDate,'days'))


//       ) {  return true;  }
//       return false;

//   }
// );

$.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {
      var min  = $('#dateFrom').val();
      var max  = $('#dateTo').val();
      var createdAt = data[4] || 0; // Our date column in the table
      //console.log(min);
      
      if  ( 
              ( min == "" || max == "" )
              || 
              ( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) ) 
          )
      {
          return true;
      }
      return false;
  }
);