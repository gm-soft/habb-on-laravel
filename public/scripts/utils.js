
(function() {

    var utils = {
        AjaxRequest : AjaxRequest,
        GetCsrfToken : GetCsrfToken
    };

    habb.utils = utils;

    /**
     * Отправляет данные аяксом
     * @param url - адрес отправки
     * @param data - данные
     * @param onSuccess - коллбэк в случае успеха
     * @param onError - коллбек в случае ошибки
     * @constructor
     */
    function AjaxRequest (url, data, onSuccess, onError) {

        if (!onError){
            onError = _onError;
        }

        $.ajax({
            url : url,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': GetCsrfToken() },
            data : data,
            success  : onSuccess,
            error : onError
        });
    }

    function GetCsrfToken() {
        return $('meta[name="csrf-token"]').attr('content');
    }

    function _onError(xhr, status, errorThrown) {
        console.log(errorThrown);
    }

}());



