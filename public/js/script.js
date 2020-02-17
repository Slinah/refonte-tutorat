$(document).ready(function() {

    //// Affichage du formulaire "plus de critères"

    //normal
    var searchButton = $('.search-button');
    var divForm = $('.form-div');

    divForm.hide();
    searchButton.click(function(){
        divForm.toggle();
    });

    //page admin - Cours
    var searchButtonCourses = $('.search-button-courses');
    var divFormCourses = $('.form-div-courses');

    divFormCourses.hide();
    searchButtonCourses.click(function(){
        divFormCourses.toggle();
    });

    //page admin - Stage
    var searchButtonInternship = $('.search-button-internship');
    var divInternship = $('.form-div-internship');

    divInternship.hide();
    searchButtonInternship.click(function(){
        divInternship.toggle();
    });

    //page admin - Matière
    var searchButtonMatiere = $('.search-button-matiere');
    var divFormMatiere = $('.form-div-matiere');

    divFormMatiere.hide();
    searchButtonMatiere.click(function(){
        divFormMatiere.toggle();
    });

//// Affichage des options déroulante

    var selectType = $('.type-search');
    var divDate = $('.date-search');
    var divTitre = $('.titre-search');
    var divMatiere = $('.matiere-search');
    var divPromo = $('.promo-search');

    //Inscrit page Admin
    var divRole = $('.role-search');
    var divClasse = $('.classe-search');

    selectType.change(function(){
        console.log(selectType.val());
        switch(selectType.val()){

            case 'date':
                divDate.show();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divRole.hide();
                divClasse.hide();
                break;

            case 'titre':
                divDate.hide();
                divTitre.show();
                divMatiere.hide();
                divPromo.hide();
                divRole.hide();
                divClasse.hide();
                break;

            case 'matiere':
                divDate.hide();
                divTitre.hide();
                divMatiere.show();
                divPromo.hide();
                divRole.hide();
                divClasse.hide();
                break;

            case 'promo':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.show();
                divRole.hide();
                divClasse.hide();
                break;

            case 'role':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divRole.show();
                divClasse.hide();
                break;

            case 'classe':
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divRole.hide();
                divClasse.show();
                break;

            default:
                divDate.hide();
                divTitre.hide();
                divMatiere.hide();
                divPromo.hide();
                divRole.hide();
                divClasse.hide();
        }
    }).trigger('change');


    //Cours
    var selectTypeCourses = $('.type-search-courses');
    var divMatiereCourses = $('.matiere-search-courses');
    var divStatusCourses = $('.status-search-courses');

    selectTypeCourses.change(function(){
        console.log(selectTypeCourses.val());
        switch(selectTypeCourses.val()){

            case 'matiereCourses':
                divMatiereCourses.show();
                divStatusCourses.hide();
                break;

            case 'statusCourses':
                divMatiereCourses.hide();
                divStatusCourses.show();
                break;

            default:
                divMatiereCourses.hide();
                divStatusCourses.hide();
        }
    }).trigger('change');


    //Stage
    var selectTypeInternship = $('.type-search-internship');
    var divMatiereInternship = $('.internship-matiere-search');
    var divStatusInternship = $('.internship-status-search');

    selectTypeInternship.change(function(){
        console.log(selectTypeInternship.val());
        switch(selectTypeInternship.val()){

            case 'matiereInternship':
                divMatiereInternship.show();
                divStatusInternship.hide();
                break;

            case 'statusInternship':
                divMatiereInternship.hide();
                divStatusInternship.show();
                break;

            default:
                divMatiereInternship.hide();
                divStatusInternship.hide();
        }
    }).trigger('change');


    //Matière
    var selectTypeMatiere = $('.type-search-matiere');
    var divValidation = $('.validation-search');

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

    //Forum
    var selectTypeForum = $('.type-search-forum');
    var divTitreForum = $('.titre-forum-search');

    selectTypeForum.change(function(){
        console.log(selectTypeForum.val());
        switch(selectTypeForum.val()){

            case 'titre':
                divTitreForum.show();
                break;

            default:
                divTitre.hide();
        }
    }).trigger('change');

});