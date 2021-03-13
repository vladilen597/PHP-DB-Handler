$(document).ready(function () {
    $("#confirmBtn").click(() => {
        var selectedOption = $("#selectPrice option:selected").val();
        var from = $("#from").val();
        var to = $("#to").val();
        var selectedQuantity = $("#selectQuantity option:selected").val();
        var quantity = $("#quantity").val();

        $("#table").load("loadData.php", {
            newSelectedOption: selectedOption,
            newFrom: from,
            newTo: to,
            newSelectedQuantity: selectedQuantity,
            newQuantity: quantity
        });
    });

    var expensive = 0;
    var cheap = 1000000;
    var index;
    var index2;
    $('#table td:nth-child(3)').each(function () {
        if (parseFloat($(this).text()) > expensive) {
            expensive = parseFloat($(this).text());
            index = $(this).closest("tr").index();
            console.log(index);
        }
    });
    $('#table td:nth-child(4)').each(function () {
        if (parseInt($(this).text()) < cheap) {
            cheap = parseInt($(this).text());
            index2 = $(this).closest("tr").index();
            console.log(index2);
        }
    });
    $(`#table tr:eq(${index}) td:nth-child(3)`).css({"background-color" : "crimson"});
    $(`#table tr:eq(${index2}) td:nth-child(4)`).css({"background-color" : "green"});
});