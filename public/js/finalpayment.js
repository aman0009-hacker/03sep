$(document).ready(function () {
    // Initially hide the amount field
    $("#divPayment").hide();
    // Show/hide the amount field based on the selected payment mode
    $("#paymentMode").change(function () {
        if ($(this).val() === "online") {
            $("#divPayment").show();
            $("#invoiceDownload").show();
            $("#Payment").modal('show');
        } else {
            $("#divPayment").hide();
            $("#invoiceDownload").hide();
        }
    });
});