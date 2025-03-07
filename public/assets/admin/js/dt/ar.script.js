$("document").ready(function () {
    $('label[for="dt-length-0"]').text("سجلات لكل صفحة");
    $('label[for="dt-search-0"]').text("البحث");

    $("table.dataTable colgroup").remove();

    $("td.dt-empty").html("لايوجد بيانات متاحة");
    $("div.dt-info").html(tableInfo($("div.dt-info").html()));
    $(".dt-column-order").click(function () {
        $("div.dt-info").html(tableInfo($("div.dt-info").html()));
    });
    // create array from tableInfo
});

const tableInfo = function (el) {
    const translatedTableInfo = el.split(" ");
    translatedTableInfo[0] = "عرض";
    translatedTableInfo[2] = "إلى";
    translatedTableInfo[4] = "من";
    translatedTableInfo[6] = translatedTableInfo[5] > 10 ? "سجل" : "سجلات";
    return translatedTableInfo.join(" ");
};
