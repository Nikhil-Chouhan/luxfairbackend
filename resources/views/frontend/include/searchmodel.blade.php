<!-- Modal -->

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" > -->

<div class="modal fade" id="superSearchModal" tabindex="-1" aria-labelledby="superSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="superSearchModalLabel">Super Search</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mt-2 mb-3">
            <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search by product name" aria-label="Search">
            <button class="btn btn-outline-primary mb-2" id="searchButton">Search</button>
          </div>
          <div id="searchResults"></div> 
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script> -->

@push('scripts')

<script>
    $(document).ready(function () {
        // When the search button is clicked
        $('#searchButton').on('click', function () {
            var query = $('#searchInput').val();
            $.ajax({
                url: '{{ route('frontend.supersearchresult') }}',
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

@endpush