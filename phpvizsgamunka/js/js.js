$(document).ready(function(){
    var directorArray = [];
    var actorArray = [];
    var categoryArray = [];
    var mDirectorArray = [];
    var mActorArray = [];
    var mCategoryArray = [];
    var da = 0;
    var ca = 0;
    var aa = 0;
    var mda = 0;
    var mca = 0;
    var maa = 0;
    
    $('#add-director').click( function (){
        da++;
        var director = $('#director0').val();
        directorArray.push(director);
        console.log(directorArray);
        $('#wrap-director').after("<div class=\"row my-3\" id=\"wrap-director" + da + "\"><label for=\"director\" class=\"col-sm-2 col-form-label\"></label><div class=\"col-sm-9 ms-0\"><input type=\"text\" class=\"form-control\" id=\"director" + da + "\" name=\"director" + da + "\" value=\"" + director + "\"></div><div class=\"col-sm-1\"></div></div>");
        $('#director0').val("");
    });
    
    $('#m-add-director').click( function (){
        mda++; //itt meg kell számolni hogy edig menny van az id miatt
        var mDirector = $('#m-director0').val();
        directorArray.push(mDirector);
        console.log(mDirectorArray);
        $('#m-wrap-director').after("<div class=\"row my-3\" id=\"m-wrap-director" + mda + "\"><label for=\"m-director\" class=\"col-sm-2 col-form-label\"></label><div class=\"col-sm-9 ms-0\"><input type=\"text\" class=\"form-control\" id=\"m-director" + mda + "\" name=\"m-director" + mda + "\" value=\"" + mDirector + "\"></div><div class=\"col-sm-1\"></div></div>");
        $('#m-director0').val("");
    });
    
    $('#add-actor').click( function (){
        aa++;
        var actor = $('#actor0').val();
        actorArray.push(actor);
        console.log(actorArray);
        $('#wrap-actor').append("<div class=\"row my-3\" id=\"wrap-actor" + aa + "\"><label for=\"actor\" class=\"col-sm-2 col-form-label\"></label><div class=\"col-sm-9 ms-0\"><input type=\"text\" class=\"form-control\" id=\"actor" + aa + "\" name=\"actor" + aa + "\" value=\"" + actor + "\"></div><div class=\"col-sm-1\"></div></div>");
        $('#actor0').val("");
    });
    
    $('#m-add-actor').click( function (){
        maa++; //itt meg kell számolni hogy edig menny van az id miatt
        var mActor = $('#m-actor0').val();
        mActorArray.push(mActor);
        console.log(mActorArray);
        $('#m-wrap-actor').after("<div class=\"row my-3\" id=\"m-wrap-actor" + maa + "\"><label for=\"m-actor\" class=\"col-sm-2 col-form-label\"></label><div class=\"col-sm-9 ms-0\"><input type=\"text\" class=\"form-control\" id=\"m-actor" + maa + "\" name=\"m-actor" + maa + "\" value=\"" + mActor + "\"></div><div class=\"col-sm-1\"></div></div>");
        $('#m-actor0').val("");
    });
    
    $('#add-category').click( function (){
        ca++;
        var category = $('#category0').val();
        categoryArray.push(category);
        console.log(categoryArray);
        $('#wrap-category').append("<div class=\"row mb-3 justify-content-end\" id=\"wrap-category" + ca + "\"><label for=\"category\" class=\"col-sm-2 col-form-label\"></label><div class=\"col-sm-9\"><input type=\"text\" class=\"form-control\" id=\"category" + ca + "\" name=\"category" + ca + "\" value=\"" + category + "\"></div></div>");
        $('#category0').val("");
    });
    
    $(function() {
        setTimeout(function() { $("#alert").fadeOut(1500); }, 5000)
    });
    
    
    $('#add-user-icon').click( function (){
        var radios = $('[name="exampleRadios"]');
        console.log(radios);
        for (var i = 1; i <= radios.length; i++) {
            if (radios[i].checked) {
                $('#signup-icon').remove();
                $('#wrap-image').append('<img class="mx-3" style="height: 40px;" id="signup-icon" src="../assets/img/user/' + radios[i].value + '">');
                break;
            }
        }
    });
    
    
});