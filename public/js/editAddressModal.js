$(document).ready(function() {
    $('#editAddressModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var address_id = button.data('address_id');
        var address_name = button.data('address_name');
        var address_district = button.data('address_district');
        var address_street = button.data('address_street');
        var address_floor = button.data('address_floor');
        var address_details = button.data('address_details');
        var modal = $(this);

        modal.find('#updateAddressForm #address_id').val(address_id);
        modal.find('#updateAddressForm #address_name').val(address_name);
        modal.find('#updateAddressForm #address_district').val(address_district);
        modal.find('#updateAddressForm #address_street').val(address_street);
        modal.find('#updateAddressForm #address_floor').val(address_floor);
        modal.find('#updateAddressForm #address_details').val(address_details);
    });
});
