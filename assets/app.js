/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';



document.addEventListener('DOMContentLoaded', function() {
    // Dropdown functionality
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!dropdownMenu.contains(event.target) && !dropdownButton.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    // Navigation bar and bottom bar functionality
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.navbar .nav-link');
    const bottomBar = document.getElementById('bottom-bar');

    if (bottomBar) {
        bottomBar.classList.add('hidden');

        navLinks.forEach(function(link) {
            const linkPath = new URL(link.href).pathname;

            if (currentPath === linkPath || (currentPath === '/' && linkPath === '#')) {
                bottomBar.classList.remove('hidden');
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // Special handling for the home page
        const homeLink = document.querySelector('.navbar .nav-link[href="/"], .navbar .nav-link[href="#"]');
        if ((currentPath === '/' || currentPath === '#') && homeLink) {
            bottomBar.classList.remove('hidden');
            homeLink.classList.add('active');
        }
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