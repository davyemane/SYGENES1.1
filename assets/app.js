/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

document.addEventListener('DOMContentLoaded', function() {
    // Get the dropdown button and menu
    var dropdownButton = document.getElementById('dropdownButton');
    var dropdownMenu = document.getElementById('dropdownMenu');

    // Toggle the dropdown menu visibility when the button is clicked
    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close the dropdown menu when clicking outside of it
    document.addEventListener('click', function(event) {
        if (!dropdownMenu.contains(event.target) && !dropdownButton.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

});

document.addEventListener("DOMContentLoaded", function() {
  var url = window.location.pathname;
  var links = document.querySelectorAll('.navbar .nav-link');
  const bottomBar = document.getElementById('bottom-bar');

  // Initially hide the bottom bar
  bottomBar.classList.add('hidden');
  
  // Find the link whose URL matches the current URL and update the bottom bar
  let activeLink = null;
  links.forEach(function(link) {
      var linkUrl = new URL(link.href).pathname;
      if (url === linkUrl || (url === '/' && linkUrl === '#')) {
          activeLink = link;
      }
  });

    links.forEach(function(link) {
    if (link.getAttribute('href') !== '/') {
       bottomBar.classList.remove('hidden');
    }
  });

  // Special handling for the home page link
  var homeLink = document.querySelector('.navbar .nav-link[href="/"], .navbar .nav-link[href="#"]');
  if ((url === '/' || url === '#') && homeLink) {
      activeLink = homeLink;
      //console.log("Here");
  }

  if (activeLink) {
      // Remove the hidden class to make the bottom bar visible
      //bottomBar.classList.remove('hidden');
  }
});


// document.addEventListener("DOMContentLoaded", function() {
//   var url = window.location.href;
//   var links = document.querySelectorAll('.navbar .nav-link');
//   var bottomBar = document.getElementById('bottom-bar');

//   // Remove 'active' class from all links except the home page link
//   links.forEach(function(link) {
//     if (link.getAttribute('href') !== '/') {
//        bottomBar.classList.add('hidden');
//     }
//   });

//   // Find the link whose URL matches the current URL and add 'active' class to it
//   links.forEach(function(link) {
//     var linkUrl = link.href;
//     if (url.indexOf(linkUrl) !== -1 ) {
//        bottomBar.classList.remove('hidden');
//     }
//   });

//   // Special handling for the home page link
//   var homeLink = document.querySelector('.navbar .nav-link[href="/"]');
//   if (url.endsWith('/') || url.endsWith('#')) {
//      bottomBar.classList.remove('hidden');
//   } else {
//      //bottomBar.classList.add('hidden');
//   }
// });