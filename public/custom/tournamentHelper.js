/**
 * Created by Next on 19.03.2017.
 */


var tournamentHelper = {
    // Листенер по нажатию кнопки добавления
    addParticipant : function(){

        var select = $('#part_select');
        var optionSelected = select.find('option:selected');

        var id = optionSelected.val();
        var name = optionSelected.text();
        if (id == '') return;
        //console.log(name+ ". id:"+id);
        tournamentHelper.addParticipantToOutputDiv(id, name);
    },

    // Нужно вызывать при генерации страницы
    registerListeners : function () {
        var addPartButton = $('#addPartButton');
        var typeSelect = $('#tournament_type');

        addPartButton.on('click', tournamentHelper.addParticipant);
        typeSelect.on('change', tournamentHelper.selectChangeListener);
    },

    // Добавляет див участника по его имени и айди
    addParticipantToOutputDiv : function(id, name) {

        var outputDiv = $('#outputDiv');

        var displDiv = document.createElement('div');
        var buttonDiv = document.createElement('div');

        $(displDiv).addClass('col-sm-8');
        $(buttonDiv).addClass('col-sm-4').addClass('text-sm-right');

        var deleteButton = document.createElement('a');
        deleteButton.href = "#";
        deleteButton.innerHTML = "Удалить <i class=\"fa fa-times\" aria-hidden=\"true\"></i>";
        $(deleteButton)
            .addClass('btn btn-outline-danger')
            .click({id: id}, tournamentHelper.deleteParticipantEvent)
            .appendTo(buttonDiv);

        displDiv.innerHTML = "<b>"+name+"</b>";
        $(displDiv).append('<input type=hidden name="participant_ids[]" value="'+id+'">');


        var participantDiv = document.createElement('div');
        participantDiv.id = 'participant_'+id;
        $(participantDiv)
            .addClass('row')
            .addClass('mt-1')
            .append(displDiv)
            .append(buttonDiv)
            .appendTo(outputDiv);
    },

    // Удаление дива участника
    deleteParticipantDiv : function(id) {
        console.log(id);
        var participantDiv = $('#participant_'+id);
        participantDiv.remove();
    },

    // Слушатель нажатия кнопки удаления
    deleteParticipantEvent : function(event) {
        // Слушатель нажатия "Удалить" напротив участника
        var data = event.data;
        var id = data.id;
        tournamentHelper.deleteParticipantDiv(id);
    },

    fillSelect2List : function (selectOptions) {

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
    },

    getParticipants : function (type) {
        var data = {type : type};
        console.log(data);
        var url = '/ajax/participantsForSelect';
        var onSuccess = function(res) {
            tournamentHelper.fillSelect2List(res);
        };
        var onError = function (res) {
            $('#part_select').prop('disabled', false);
        }
        httpHelpers.AjaxRequest(url, data, onSuccess, onError);
    },

    selectChangeListener : function() {
        var typeSelect = $('#tournament_type');
        $('#part_select').prop('disabled', true);

        var option = typeSelect.find('option:selected');
        tournamentHelper.getParticipants(option.val());
    }

};









