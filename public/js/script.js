$(document).ready(function() {

    //// Affichage du formulaire "plus de critères"

    var searchButton = $('.search-button');
    var divForm = $('.form-div');

    divForm.hide();

    searchButton.click(function(){
        divForm.toggle();
    });

//// Affichage des options déroulante

    var selectType = $('.type-search');
    var divDate = $('.date-search');
    var divTitre = $('.titre-search');
    var divMatiere = $('.matiere-search');
    var divPromo = $('.promo-search');

    selectType.change(function(){
        console.log(selectType.val());
        switch(selectType.val()){

            case 'date':
                divDate.show();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                break;

            case 'titre':
                divDate.hide();
                divTitre.show();
                divMatiere.hide();
                divPromo.hide();
                break;

            case 'matiere':
                divDate.hide();
                divTitre.hide();
                divMatiere.show();
                divPromo.hide();
                break;

            case 'promo':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.show();
                break;

            default:
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
        }

    }).trigger('change');

});