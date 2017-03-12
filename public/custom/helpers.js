/**
 * Created by Next on 24.02.2017.
 */

var formHelpers = {

    RequestDataToSelect: function (selectElement, type, sourceTrigger) {
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
        });
    },

};

var registrationHelpers = {
    phoneInput :        null,
    emailInput :        null,
    sbtBtn :            null,
    divPhone :          null,
    divEmail :          null,
    accountModalTitle : null,
    accountModalBody :  null,
    vkInput :           null,

    _markFields : function(field, statement) {

        if (statement == true) {

            if (field == "phone") {

                this.phoneInput.addClass("form-control-danger");
                this.phoneInput.removeClass("form-control-success");

                this.divPhone.addClass("has-danger");
                this.divPhone.removeClass("has-success");


            } else if (field == "email") {
                this.emailInput.addClass("form-control-danger");
                this.emailInput.removeClass("form-control-success");

                this.divEmail.addClass("has-danger");
                this.divEmail.removeClass("has-success");
            }
            this.sbtBtn.prop("disabled", true);


        } else {
            if (field == "phone") {

                this.phoneInput.addClass("form-control-success");
                this.phoneInput.removeClass("form-control-danger");

                this.divPhone.addClass("has-success");
                this.divPhone.removeClass("has-danger");

            } else if (field == "email") {
                this.emailInput.addClass("form-control-success");
                this.emailInput.removeClass("form-control-danger");

                this.divEmail.addClass("has-success");
                this.divEmail.removeClass("has-danger");
            }

            this.sbtBtn.prop("disabled", false);
        }
    },

    _searchValue : function(field, value) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url = "/ajax/search-gamer";
        var paramsData = {
            "_token" : CSRF_TOKEN,
            "field" : field,
            "value" : value
        };



        var request = $.ajax({
            url : url,
            data : paramsData,
            type : "POST",
            success : function(data, textStatus){

                console.log(data);
                /*var result = data["result"];
                var account = data["account"];
                this.MarkFields(field, result);
                if (result == false && account == null) return;
                $('#accountModal').modal('show');*/
            }
        });
    },

    RegisterListeners : function () {

        this.phoneInput        = $('#phone');
        this.emailInput        = $('#email');
        this.sbtBtn            = $('#submit-btn');
        this.divPhone          = $('#divPhone');
        this.divEmail          = $('#divEmail');
        this.accountModalTitle = $('#accountModalTitle');
        this.accountModalBody  = $('#accountModalBody');
        this.vkInput           = $('#vk');

        this.vkInput.focus(function(){

            if ($(this).val() == "") {
                $(this).val("https://vk.com/");
                return;
            }
        });

        this.vkInput.blur(function () {
            if ($(this).val() == "https://vk.com/") {
                $(this).val("");
                return;
            }
        });

        $('#modalConfirmButton').on('click', function(){
            $('#inqured').prop('checked', true);
        });

        this.phoneInput.blur(function(){
            if ($(this).val() == "")  {

                $(this).removeClass("form-control-danger");
                $(this).removeClass("form-control-success");
                registrationHelpers.divPhone.removeClass("has-danger");
                registrationHelpers.divPhone.removeClass("has-success");
                return;
            }

            registrationHelpers._searchValue("phone", $(this).val());
        });

        this.emailInput.blur(function(){

            if ($(this).val() == "")  {

                $(this).removeClass("form-control-danger");
                $(this).removeClass("form-control-success");
                registrationHelpers.divEmail.removeClass("has-danger");
                registrationHelpers.divEmail.removeClass("has-success");
                return;
            }
            registrationHelpers._searchValue("email", $(this).val());
        });
    },

};


var ckEditorHelpers = {

    replace : function(textareaName) {
        CKEDITOR.config.language = 'ru';
        CKEDITOR.replace(textareaName, {});
    },
};


