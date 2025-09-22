let table = new DataTable("#myTable", {
  // options
  language: {
    url: "js/data.table.ar.json",
  },
  info: false,
  responsive: true
});

$("#search-datatable").on("keyup", function () {
  table.search(this.value).draw();
});


function dataTableFilter(column, status = null) {
  if (status == null) {
    table.column(column).search("").draw();
  } else {
    table.column(column).search(status).draw();
  }
}
 