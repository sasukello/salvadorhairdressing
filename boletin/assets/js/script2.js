$('#boletin1').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var modal = $(this);

    document.getElementById("p1-desc").innerHTML = "Esto puede demorar un poco...";
    //modal.find('.modal-body input').val(recipient+";"+recipientu);
    //document.getElementById('pnombre').innerHTML = atob(valor2);
    document.getElementById("p1-desc").innerHTML = '<iframe style="width:100%; height:500px;" src="//e.issuu.com/embed.html#30851590/55045017" frameborder="0" allowfullscreen></iframe>';
});

$('#boletin2').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var edicion = button.data('edicion'); var modal = $(this);

    document.getElementById("p2-desc").innerHTML = "Esto puede demorar un poco...";
        //modal.find('.modal-body input').val(recipient+";"+recipientu);
        //document.getElementById('pnombre').innerHTML = atob(valor2);
        document.getElementById("p2-desc").innerHTML = '<iframe style="width:100%; height:500px;" src="//e.issuu.com/embed.html#30851590/58100538" frameborder="0" allowfullscreen></iframe>';
});

$('#boletin3').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var edicion = button.data('edicion'); var modal = $(this);

    document.getElementById("p2-desc").innerHTML = "Esto puede demorar un poco...";
        //modal.find('.modal-body input').val(recipient+";"+recipientu);
        //document.getElementById('pnombre').innerHTML = atob(valor2);
    document.getElementById("p2-desc").innerHTML = '<iframe style="width:100%; height:500px;" src="//e.issuu.com/embed.html#30851590/64584602" frameborder="0" allowfullscreen></iframe>';
});

$('#boletin4').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var edicion = button.data('edicion'); var modal = $(this);

    document.getElementById("p2-desc").innerHTML = "Esto puede demorar un poco...";
        //modal.find('.modal-body input').val(recipient+";"+recipientu);
        //document.getElementById('pnombre').innerHTML = atob(valor2);
    document.getElementById("p2-desc").innerHTML = '<iframe style="width:100%; height:500px;" src="//e.issuu.com/embed.html#30851590/66789419" frameborder="0" allowfullscreen></iframe>';
});

$("#boletin5").on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var edicion = button.data("edicion");
    var modal = $(this);

    document.getElementById("p2-desc").innerHTML = "Esto puede demorar un poco...";

    document.getElementById("p2-desc").innerHTML = '<iframe style="width:100%; height:500px;" src="//e.issuu.com/embed.html#30851590/69762810" frameborder="0" allowfullscreen></iframe>';
});
                                                    

$(document).ready(function () {
        // Menu.
    var $menu = $('#menu');
    var $body = $('body');

    $menu.wrapInner('<div class="inner"></div>');

    $menu._locked = false;

    $menu._lock = function() {

        if ($menu._locked)
            return false;

        $menu._locked = true;

        window.setTimeout(function() {
            $menu._locked = false;
        }, 350);

        return true;

    };

    $menu._show = function() {

        if ($menu._lock())
            $body.addClass('is-menu-visible');

    };

    $menu._hide = function() {

        if ($menu._lock())
            $body.removeClass('is-menu-visible');

    };

    $menu._toggle = function() {

        if ($menu._lock())
            $body.toggleClass('is-menu-visible');

    };

    $menu
        .appendTo($body)
        .on('click', function(event) {
            event.stopPropagation();
        })
        .on('click', 'a', function(event) {

            var href = $(this).attr('href');

            event.preventDefault();
            event.stopPropagation();

            // Hide.
                $menu._hide();

            // Redirect.
                if (href == '#menu')
                    return;

                window.setTimeout(function() {
                    window.location.href = href;
                }, 350);

        })
        .append('<a class="close" href="#menu">Close</a>');

    $body
        .on('click', 'a[href="#menu"]', function(event) {

            event.stopPropagation();
            event.preventDefault();

            // Toggle.
                $menu._toggle();

        })
        .on('click', function(event) {

            // Hide.
                $menu._hide();

        })
        .on('keydown', function(event) {

            // Hide on escape.
                if (event.keyCode == 27)
                    $menu._hide();

        });

});
//----- Popup Start ------



/*$('.grid').masonry({
  // options
  itemSelector: '.grid-item',
  columnWidth: 200
});
*/