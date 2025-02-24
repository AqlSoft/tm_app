$('label[for="dt-length-0"]').text("سجلات لكل صفحة");
$('label[for="dt-search-0"]').text("البحث");
$('label[for="dt-search-0"]').nextNode().remove();
$("table.dataTable colgroup").remove();
$("table.dataTable colgroup").css("width", "100%");
