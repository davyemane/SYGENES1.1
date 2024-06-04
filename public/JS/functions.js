$(document).ready(function() {
    // Get the current page filename (without extension)
    var currentPage = window.location.pathname.split('/').pop().split('.')[0];
  
    // Remove any existing active class
    $(".nav-link").removeClass("active");
  
    // Find the navigation link matching the current page and add active class
    $(".nav-link").each(function() {
      var linkHref = $(this).attr("href").split('/').pop().split('.')[0];
      if (currentPage === linkHref) {
        $(this).addClass("active");
      }
    });
  });
  