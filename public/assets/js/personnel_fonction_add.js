$(document).ready(function() {

    $('#personnel_fonctions').on('change', function() {
  $("#personnel_groupement").parent().hide();
        switch (this.value) {


            case "2" : {

                $("#personnel_secteur").parent().hide();
                $("#personnel_departement").parent().show();
            } break;
            case "3" : {    $("#personnel_secteur").parent().hide();
                $("#personnel_departement").parent().show();
            } break;
            case "4" : {    $("#personnel_secteur").parent().show();
                $("#personnel_departement").parent().hide();
            } break;
            case "5" : {    $("#personnel_secteur").parent().show();
                $("#personnel_departement").parent().hide();
                $("#personnel_groupement").parent().show();
            } break;

            case "6" : {    $("#personnel_secteur").parent().show();
                $("#personnel_departement").parent().show();
            } break;


        }
    });



})