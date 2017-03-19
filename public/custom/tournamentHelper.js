/**
 * Created by Next on 19.03.2017.
 */


var tournamentHelper = {
    addParticipant : addParticipant,
    registerListeners : registerListeners,
    addParticipantToOutputDiv : addParticipantToOutputDiv,
    deleteParticipantDiv : deleteParticipantDiv,
    deleteParticipantEvent : deleteParticipantEvent
};


function addParticipant() {
    var select = $('#part_select');
    var optionSelected = select.find('option:selected');

    var id = optionSelected.val();
    var name = optionSelected.text();
    if (id == '') return;
    //console.log(name+ ". id:"+id);
    addParticipantToOutputDiv(id, name);
}

function registerListeners() {
    var addPartButton = $('#addPartButton');
    addPartButton.on('click', addParticipant);
}

function addParticipantToOutputDiv(id, name) {
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
        .click({id: id}, deleteParticipantEvent)
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
}

function deleteParticipantEvent(event) {
    var data = event.data;
    var id = data.id;
    deleteParticipantDiv(id);
}

function deleteParticipantDiv(id) {
    console.log(id);
    var participantDiv = $('#participant_'+id);
    participantDiv.remove();
}