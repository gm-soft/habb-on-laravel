
<div id="modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">{{ $title }}</h2>
        </div>
        <div class="uk-modal-body">
            {{ $body }}
        </div>
        <div class="uk-modal-footer">
            <div class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Закрыть</button>
            </div>
        </div>

    </div>
</div>