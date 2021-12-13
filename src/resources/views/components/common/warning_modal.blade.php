<!-- Button trigger modal-->
    {{ $modal_view_button }}

<!-- Central Modal Medium Warning -->
<div class="modal fade" id="centralModalWarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content">
        <!--Header-->
            <div class="modal-header">
                <p class="heading lead ml-3">{{ $modal_header }}</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                    <p>{{ $modal_body }}</p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center" role="group" aria-label="modal-button">
                <button type="button" class="py-2 mr-4 btn btn-outline-warning" data-dismiss="modal">キャンセル</button>
                {{ $modal_submit_button }}
            </div>
        <!--/.Content-->
        </div>
    </div>
</div>
<!-- Central Modal Medium Warning-->
