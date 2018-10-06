
(function(){

    habb.formHelpers = {
        RequestDataToSelect : RequestDataToSelect,
        BackendImageListSelectorInit: BackendImageListSelectorInit,
        setImagePathToInput: setImagePathToInput,
        sendPreviewRequest: sendPreviewRequest
    };;


    function CkEditorInit(textAreaSelector){
        // TODO Gorbatyuk: этот метод не используется, потмоу что поломан пробел в ckeditor 5
        ClassicEditor
            .create( document.querySelector(textAreaSelector) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    }

    function RequestDataToSelect(selectElement, type, sourceTrigger) {
        selectElement.prop("disabled", true);
        sourceTrigger.prop("disabled", true);

        selectElement.find('option').remove();
        var request = $.ajax({
            url: "/rest/ajax.php",
            data: {
                "action": "select2.participants.get",
                "type": type
            },
            type: "POST",
            success: function (data, textStatus) {
                var result = data["result"];
                var count = data["count"];
                console.log("Received " + count + " items of array");
                for (var i = 0; i < count; i++) {
                    var item = result[i];
                    selectElement.append("<option value='" + item["value"] + "'>" + item["text"] + "</option>")
                }
                selectElement.prop("disabled", false);
                sourceTrigger.prop("disabled", false);

            },
            fail: function (data, textStatus) {
                selectElement.prop("disabled", false);
                sourceTrigger.prop("disabled", false);
            }
        })
    }

    function BackendImageListSelectorInit(urlToFilesJson){

        $('.choose_btn__tag').click(function(){

            if ($(this).attr('aria-expanded')){

                var listDiv = $('.choose_image_list__tag');

                habb.utils.AjaxRequest(urlToFilesJson, null, function(response){
                    listDiv.empty();

                    for (var index = 0; index < response.length; index++){
                        var item = "<a href='#' class='dropdown-item choose_list_item__tag' " +
                            "onclick='habb.formHelpers.setImagePathToInput(\"" + response[index].filepath +"\")'>" + response[index].filepath + "<a/>";
                        listDiv.append(item);
                    }
                });
            }

        });
    }

    function setImagePathToInput(imagePath){
        $('.image_form_control__tag').val(imagePath);
    }

    function sendPreviewRequest(url){

        // нужно заменить контент в массиве передаваемых значений, потому что его нет на самом деле
        var data = $('.form__tag').serializeArray();
        for(var key in data){
            if( !data.hasOwnProperty(key))
                continue;

            if (data[key].name === 'content'){
                data[key].value = CKEDITOR.instances['ckeditor'].getData();
                break;
            }
        }

        habb.utils.AjaxRequest(url, data, function(response){

            var w = window.open('about:blank');
            w.document.open();
            w.document.write(response);
            w.document.close();
        });
    }
}());