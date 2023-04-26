(function($){
    $(document).ready(function () {
        $('.rs_dir').click(function (e) {
            if (e.target != this) return;
            $(this).toggleClass('open');
            $(this).find('>.rs_list').toggle('slow');
        });
    });
})(jQuery);
