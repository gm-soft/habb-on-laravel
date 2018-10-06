
(function(){

    var formHelpers = {
        CkEditorInit: CkEditorInit,
        RequestDataToSelect : RequestDataToSelect,
        BackendImageListSelectorInit: BackendImageListSelectorInit,
        setImagePathToInput: setImagePathToInput
    };

    habb.formHelpers = formHelpers;

    function CkEditorInit(textAreaSelector){
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
}());