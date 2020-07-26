$(document).ready(function() {
    var rating = $('#rating').html();
    var outer = $('#outer');
    if(rating ==0){
    }else if(rating <= 1 && rating >0){
        outer.addClass("c-1");
    }else if(rating <= 2){
        outer.addClass("c-2");
    }else if(rating <= 3){
        outer.addClass("c-3");
    }else if(rating <= 4){
        outer.addClass("c-4");
    }else if(rating <= 5){
        outer.addClass("c-5");
    }else if(rating <= 6){
        outer.addClass("c-6");
    }else if(rating <= 7){
        outer.addClass("c-7");
    }else if(rating <= 8){
        outer.addClass("c-8");
    }else if(rating <= 9){
        outer.addClass("c-9");
    }else if(rating == 10){
        outer.addClass("c-10");
    }
});
