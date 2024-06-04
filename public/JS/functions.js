document.addEventListener("DOMContentLoaded", function() {
  var url = window.location.href;
  var links = document.querySelectorAll('.navbar .nav-link');

  // Remove 'active' class from all links except the home page link
  links.forEach(function(link) {
    if (link.getAttribute('href') !== '/') {
      link.classList.remove('active');
    }
  });

  // Find the link whose URL matches the current URL and add 'active' class to it
  links.forEach(function(link) {
    var linkUrl = link.href;
    if (url.indexOf(linkUrl) !== -1 ) {
      link.classList.add('active');
    }
  });

  // Special handling for the home page link
  var homeLink = document.querySelector('.navbar .nav-link[href="/"]');
  if (url.endsWith('/') || url.endsWith('#')) {
    homeLink.classList.add('active');
  } else {
    homeLink.classList.remove('active');
  }
});