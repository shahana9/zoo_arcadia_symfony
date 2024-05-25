import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

// Import Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';

// Import Bootstrap JavaScript
import 'bootstrap';

// You can also import Popper.js if you need it for tooltips and popovers
import '@popperjs/core';
import './styles/app.css';
import '../templates/common_front/style.css';
import '../templates/home/style.css';
import '../templates/services/style.css';
import '../templates/habitats/style.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
