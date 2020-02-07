$(document).ready(function() {

    //// Affichage du formulaire "plus de critères"

    // pour toute les barres de recherche normal
    var searchButton = $('.search-button');
    var divForm = $('.form-div');

    divForm.hide();
    searchButton.click(function(){
        divForm.toggle();
    });

    // pour les stages page admin
    var internshipSearchButton = $('.internship-search-button');
    var internshipDivForm = $('.internship-form-div');

    internshipDivForm.hide();
    internshipSearchButton.click(function(){
        internshipDivForm.toggle();
    });

    // pour les matières page admin
    var matiereSearchButton = $('.matiere-search-button');
    var matiereDivForm = $('.matiere-form-div');

    matiereDivForm.hide();
    matiereSearchButton.click(function(){
        matiereDivForm.toggle();
    });

//// Affichage des options déroulante

    var selectType = $('.type-search');
    var divDate = $('.date-search');
    var divTitre = $('.titre-search');
    var divMatiere = $('.matiere-search');
    var divPromo = $('.promo-search');
    var divStatus = $('.status-search');
    var divRole = $('.role-search');
    var divClasse = $('.classe-search');
    // pour les autres barre de recherche
    var selectTypeAdmin = $('.type-search-admin');
    var divMatiereInternship = $('.internship-matiere-search');
    var divStatusInternship = $('.internship-status-search');

    var selectTypeMatiere = $('.type-search-matiere');
    var divValidation = $('.validation-search');

    selectType.change(function(){
        console.log(selectType.val());
        switch(selectType.val()){

            case 'date':
                divDate.show();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divStatus.hide();
                divRole.hide();
                divClasse.hide();
                break;

            case 'titre':
                divDate.hide();
                divTitre.show();
                divMatiere.hide();
                divPromo.hide();
                divStatus.hide();
                divRole.hide();
                divClasse.hide();
                break;

            case 'matiere':
                divDate.hide();
                divTitre.hide();
                divMatiere.show();
                divPromo.hide();
                divStatus.hide();
                divRole.hide();
                divClasse.hide();
                break;

            case 'promo':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.show();
                divStatus.hide();
                divRole.hide();
                divClasse.hide();
                break;

            case 'status':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divStatus.show();
                divRole.hide();
                divClasse.hide();
                break;

            case 'role':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divStatus.hide();
                divRole.show();
                divClasse.hide();
                break;

            case 'classe':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divStatus.hide();
                divRole.hide();
                divClasse.show();
                break;

            default:
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divStatus.hide();
                divRole.hide();
                divClasse.hide();
        }
    }).trigger('change');

    selectTypeAdmin.change(function(){
        console.log(selectTypeAdmin.val());
        switch(selectTypeAdmin.val()){

            case 'matiereInternship':
                divMatiereInternship.show();
                divStatusInternship.hide();
                break;

            case 'statusInternship':
                divMatiereInternship.hide();
                divStatusInternship.show();
                break;

            case 'validation':
                divMatiereInternship.hide();
                divStatusInternship.hide();
                break;

            default:
                divMatiereInternship.hide();
                divStatusInternship.hide();
        }
    }).trigger('change');

    selectTypeMatiere.change(function(){
        console.log(selectTypeMatiere.val());
        switch(selectTypeMatiere.val()){

            case 'validation':
                divValidation.show();
                break;

            default:
                divValidation.hide();
        }
    }).trigger('change');

});