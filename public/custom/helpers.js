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

    AddGamerToTeam: function () {
        var select2 = $('#gamer_id_select');
        var option = select2.find('option:selected');

        var gamerId = option.val();
        var gamerName = option.text();
        console.log(gamerId + " " + gamerName);
        //-------------
        var gamersDiv = $('#gamers_selected');
        var inputs = gamersDiv.find('input');
        console.log(inputs.length);
    },

    AddGamerInput: function () {

    },

    RemoveGamerInput: function () {

    }

};


