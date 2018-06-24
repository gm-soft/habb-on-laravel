
(function(){

    var registrationHelpers = {
        RegisterListeners : RegisterListeners
    };

    habb.registrationHelpers = registrationHelpers;

    var _phoneInput=null;
    var _emailInput = null;
    var _submitBtn = null;
    var _phoneInputDivWrapper = null;
    var _emailInputDivWrapper = null;
    var _vkInput = null;
    var _accountModal = null;

    var _cssClasses = {
        dangerInputClass : "form-control-danger",
        successInputClass : "form-control-success",

        formGroupHasSuccess : "has-success",
        formGroupHasDanger: "has-danger",
    };


    function RegisterListeners() {

        _phoneInput = $('.habb_input-phone__tag');

        _phoneInputDivWrapper = $('.habb_form-group-phone__tag');

        _emailInput        = $('.habb_input-email__tag');

        _emailInputDivWrapper = $('.habb_form-group-email__tag');

        _submitBtn           = $('#submit-btn');

        _accountModal = $('.habb_account_modal__tag');

        _vkInput           = $('.habb_input-vk__tag');

        _vkInput.focus(function(){
            if (!$(this).val()) {
                $(this).val("https://vk.com/");
            }
        });

        _vkInput.blur(function () {
            var self = $(this);
            if (self.val() === "https://vk.com/") {
                self.val("");
            }
        });

        $('.habb_modal-confirm-btn__tag').on('click', function() {
            $('.habb_form-check-input__tag').prop('checked', true);
        });

        _phoneInput.blur(function(){
            var self = $(this);
            if (!self.val())  {

                self.removeClass(_cssClasses.dangerInputClass)
                    .removeClass(_cssClasses.successInputClass);

                _phoneInputDivWrapper
                    .removeClass(_cssClasses.formGroupHasDanger)
                    .removeClass(_cssClasses.formGroupHasSuccess);
                return;
            }

            _searchValue("phone", self.val());
        });

        _emailInput.blur(function(){

            var self = $(this);
            if (!self.val())  {

                self.removeClass(_cssClasses.dangerInputClass)
                    .removeClass(_cssClasses.successInputClass);

                _emailInputDivWrapper
                    .removeClass(_cssClasses.formGroupHasDanger)
                    .removeClass(_cssClasses.formGroupHasSuccess);
                return;
            }
            _searchValue("email", self.val());
        });
        $('.habb_form__tag').submit(function() {
            _submitBtn.prop('disabled', true);
        });

        var birthdayTag = $('.habb_input-birthday__tag');
        birthdayTag.blur(function () {
                $(this).prop('type', 'text');
            });
        birthdayTag.focus(function(){
            $(this).prop('type', 'date');
        });

        //----------------
        // Дополнительные инициирующие функции. Ожидается, что либы уже добавлены в проект
        _phoneInput.inputmask({"mask": "8(999)999-9999"});
        $('.select2').select2();
        $(".select2-multiple").select2({
            placeholder: "Иногда играю (можно выбрать несколько)",
        });

        $(".select2-single").select2({
            placeholder: "Играю активно",
        });
    }

    function _searchValue(field, value) {

        var url = "/ajax/search-gamer";
        var paramsData = {
            "field" : field,
            "value" : value
        };
        var habbIdSpan = $(".habb-id__tag");

        var successHandler = function(data, textStatus, xhr){
            var result = data["result"];
            var exists = data["exists"];
            var habbId = data["habb_id"];

            _markFields(field, exists);
            if (exists === false) {
                habbIdSpan.html("");
                return;
            }

            habbIdSpan.html(habbId);
            _accountModal.modal('show');
        };
        habb.utils.AjaxRequest(url, paramsData, successHandler);
    }

    function _markFields(field, statement) {

        var element, wrapper;
        if (field === "phone") {
            element = _phoneInput;
            wrapper = _phoneInputDivWrapper;

        } else if (field === "email") {
            element = _emailInput;
            wrapper = _emailInputDivWrapper;
        }

        if (statement === true)
        {
            _markElementDanger(element, wrapper);
        }
        else
        {
            _markElementSuccess(element, wrapper);
        }
        _submitBtn.prop("disabled", statement);
    }

    function _markElementDanger(el, wrapper) {

        el.removeClass(_cssClasses.successInputClass)
            .addClass(_cssClasses.dangerInputClass);

        wrapper
            .removeClass(_cssClasses.formGroupHasSuccess)
            .addClass(_cssClasses.formGroupHasDanger);
    }

    function _markElementSuccess(el, wrapper) {

        el.removeClass(_cssClasses.dangerInputClass)
            .addClass(_cssClasses.successInputClass);

        wrapper
            .removeClass(_cssClasses.formGroupHasDanger)
            .addClass(_cssClasses.formGroupHasSuccess);
    }
}());