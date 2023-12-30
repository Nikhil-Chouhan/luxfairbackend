<!-- Modal -->
<div class="modal fade" id="superSearchModal" tabindex="-1" role="dialog" aria-labelledby="superSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="superSearchModalLabel">Super Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search by product name">
                </div>
                <button type="button" class="btn btn-primary" id="searchButton">Search</button>
       
            </div>
        </div>
    </div>
</div>


<!-- Add this JavaScript to your layout file -->
<script src="{{ asset('frontend/js/jquery-3.2.1.min.js')}}"></script>


<script>
    $(document).ready(function () {
        // When the search button is clicked
        $('#searchButton').on('click', function () {
            var query = $('#searchInput').val();

            // Perform AJAX request to the server
            $.ajax({
                url: '{{ route('frontend.supersearch') }}',
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    // Update the search results div with the returned HTML
                    $('#searchResults').html(data);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

