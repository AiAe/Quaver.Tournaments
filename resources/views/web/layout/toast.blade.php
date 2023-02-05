@if(session()->has('toast'))
    @php($toast = session()->get('toast'))

    @if(is_array($toast))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="toast" class="toast" role="alert" aria-live="assertive"
                 aria-atomic="true" {!! (!$toast['hide']) ? 'data-bs-autohide="false"' : '' !!}>
                @if($toast['title'])
                    <div class="toast-header">
                        <strong class="me-auto">{{ $toast['title'] }}</strong>
                        @if(!$toast['hide'])
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        @endif
                    </div>
                @endif
                <div class="toast-body">
                    @if(!$toast['title'] && !$toast['hide'])
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    @endif
                    {{ $toast['message'] }}
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                (new Bootstrap.Toast(document.getElementById('toast'))).show();
            });
        </script>
    @endif

    {{ session()->forget('toast') }}
@endif
