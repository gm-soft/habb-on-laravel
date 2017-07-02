
(function() {

    habb.tournamentHelpers = {
        registerListeners : registerListeners,
        deleteParticipantDiv : deleteParticipantDiv
    };

    // Нужно вызывать при генерации страницы
    function registerListeners () {
        var addPartButton = $('#addPartButton');
        var typeSelect = $('#tournament_type');

        addPartButton.on('click', _addParticipant);
        typeSelect.on('change', _selectChangeListener);

        var removeButton = $('.habb_btn-participant-remove__tag');
        removeButton.click(function(){
            var id = $(this).attr('data-participant-id');
            habb.tournamentHelpers.deleteParticipantDiv(id);
        });
    }

    // Листенер по нажатию кнопки добавления
    function _addParticipant (){

        var select = $('#part_select');
        var optionSelected = select.find('option:selected');

        var id = optionSelected.val();
        var name = optionSelected.text();
        if (id === '') return;

        _addParticipantToOutputDiv(id, name);
    }



    // Добавляет див участника по его имени и айди
    function _addParticipantToOutputDiv(id, name) {

        var outputDiv = $('#outputDiv');

        var displayDiv = document.createElement('div');
        var buttonDiv = document.createElement('div');

        $(displayDiv).addClass('col-sm-8');
        $(buttonDiv).addClass('col-sm-4').addClass('text-sm-right');

        var deleteButton = document.createElement('a');
        deleteButton.href = "#";
        deleteButton.innerHTML = "Удалить <i class=\"fa fa-times\" aria-hidden=\"true\"></i>";
        $(deleteButton)
            .attr('data-participant-id', id)
            .addClass('btn btn-outline-danger')
            .addClass('habb_div-participant-remove__tag')
            .click({id: id}, _deleteParticipantEvent)
            .appendTo(buttonDiv);

        displayDiv.innerHTML = "<b>"+name+"</b>";
        $(displayDiv).append('<input type=hidden name="participant_ids[]" value="'+id+'">');


        var participantDiv = document.createElement('div');
        $(participantDiv)
            .attr('data-participant-id', id)
            .addClass('row')
            .addClass('mt-1')
            .append(displayDiv)
            .append(buttonDiv)
            .appendTo(outputDiv);
    }

    // Удаление дива участника
    function deleteParticipantDiv (id) {

        var divs = $('.habb_participant-wrapper__tag');
        var div = divs.find("[data-participant-id="+id+"]");
        div.remove();
    }

    // Слушатель нажатия кнопки удаления
    function _deleteParticipantEvent (event) {
        // Слушатель нажатия "Удалить" напротив участника
        var data = event.data;
        var id = data.id;
        habb.tournamentHelpers.deleteParticipantDiv(id);
    }

    function _fillSelect2List (selectOptions) {

        var select = $('#part_select');
        select.find('option').remove();
        $('#outputDiv').find('div').remove();

        for (var i = 0; i < selectOptions.length; i++) {
            var value = selectOptions[i].id;
            var text = selectOptions[i].text;

            var option = "<option value='"+value+"'>"+text+"</option>";
            select.append(option);
        }
        select.prop('disabled', false);
    }

    function getParticipants (type) {
        var data = {type : type};

        var url = '/ajax/participantsForSelect';

        var onSuccess = function(res) {
            _fillSelect2List(res);
        };
        var onError = function (xhr, status, errorThrown) {
            $('#part_select').prop('disabled', false);
        }
        habb.utils.AjaxRequest(url, data, onSuccess, onError);
    }

    function _selectChangeListener () {
        var typeSelect = $('#tournament_type');
        $('#part_select').prop('disabled', true);

        var option = typeSelect.find('option:selected');
        getParticipants(option.val());
    }

}());









