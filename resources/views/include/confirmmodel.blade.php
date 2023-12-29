<!-- Add this modal structure to your layout file -->

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmationText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="confirmAction" class="btn btn-danger">Confirm</a>
            </div>
        </div>
    </div>
</div>

<!-- Add this JavaScript to your layout file -->

<script>
    function showConfirmationModal(action) {
        $('#confirmationText').text("Are you sure you want to delete this?");
        $('#confirmAction').attr('href', action);
        $('#confirmationModal').modal('show');
    }
</script>
