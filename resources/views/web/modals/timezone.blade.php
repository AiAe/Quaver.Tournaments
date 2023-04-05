<div class="modal modal-lg fade" id="userTimezoneUpdate" tabindex="-1"
     aria-labelledby="userTimezoneUpdateLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userTimezoneUpdateLabel">{{ __('Set timezone') }}</h5>
            </div>
            {{ Form::open(['url' => route('web.users.update')]) }}
            @method('PUT')
            <div class="modal-body">
                <p class="text-warning">
                    {{ __('Please set your timezone, so we can properly generate schedules that will work for you!') }}
                </p>
                <div class="form-group">
                    <label class="form-label">{{ __('Timezone') }}</label>
                    {{ Form::select('timezone_offset', [null => __('Select timezone')] + list_utc_offsets(), $loggedUser['timezone_offset']??null, ['class' => 'form-control']) }}
                    <small>{{ __('Detected timezone') }}: <span id="detected-timezone-modal"></span></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<script>
    const browserTimezoneModal = -(new Date().getTimezoneOffset() / 60);

    document.getElementById('detected-timezone-modal').textContent = browserTimezoneModal < 0 ? `UTC${browserTimezoneModal}` : `UTC+${browserTimezoneModal}`;

    document.addEventListener("DOMContentLoaded", function () {
        const userTimezoneUpdate = new Bootstrap.Modal('#userTimezoneUpdate', {
            backdrop: 'static',
            keyboard: false
        });
        userTimezoneUpdate.show();
    });
</script>
