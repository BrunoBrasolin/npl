$(document).ready(function () {
  var openNavButton = $("#openNav");
  var sidebar = $("#sidebar");
  var scroll = $(document).scrollTop();
  if (scroll < 570) { // recarregar a página no topo dela
    openNavButton.fadeOut('slow');
  } else if (scroll >= 570) { // caso regarregue a página e não esteja no início
    openNavButton.fadeIn('slow');
    $("#closeNav").click(function () { // fechar sidebar
      openNavButton.fadeIn('slow');
      sidebar.fadeOut('slow');
    })
    openNavButton.click(function () { // abrir sidebar
      openNavButton.fadeOut('fast');
      sidebar.fadeIn();
    })
  }

  $(document).scroll(function () { // função ao dar scroll
    sidebar.fadeOut();
    scroll = $(document).scrollTop();
    if (scroll < 570) { // quando a página chega no topo
      openNavButton.fadeOut();
    } else if (scroll >= 570) { // quando a página não está no topo
      openNavButton.fadeIn('slow');
      $("#closeNav").click(function () { // fechar sidebar
        openNavButton.fadeIn('slow');
        sidebar.fadeOut('slow');
      })
      openNavButton.click(function () { // abrir sidebar
        openNavButton.fadeOut('fast');
        sidebar.fadeIn();
      })
    }
  })
})
