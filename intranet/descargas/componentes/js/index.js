var working = false;
$('.login').on('submit', function(e) {
  e.preventDefault();
  if (working) return;
  working = true;
  var $this = $(this),
    $state = $this.find('button > .state');
  $this.addClass('loading');
  $state.html('Autenticando');
  setTimeout(function() {
    $this.addClass('ok');
    $state.html('&#161;Verificaci&#243;n &#201;xitosa!');
    setTimeout(function() {
      $state.html('Entrar');
      $this.removeClass('ok loading');
      working = false;
    }, 4000);
  }, 3000);
});