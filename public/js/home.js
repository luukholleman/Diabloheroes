(function(){
    "use strict";

    $('a.ranklist-filter').click(function(){
        $(this).siblings('ul').toggleClass('hidden');

        return false;
    });
})();