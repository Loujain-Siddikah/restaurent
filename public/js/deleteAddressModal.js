$(document).ready(function() {
    $('#deleteAddressModal').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var address_id = button.data('address_id')
        var address_name = button.data('address_name')
        var modal = $(this)
        modal.find('#address_id').val(address_id);
        modal.find('#address_name').val(address_name);
    });
});