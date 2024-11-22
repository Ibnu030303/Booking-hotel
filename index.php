<?php
require 'components/Header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Only include Navbar if the page is not 'login'
if ($page !== 'login') {
    require 'components/Navbar.php';
}

switch ($page) {
    case 'login':
        include 'views/login.php';
        break;
    case 'home':
    default:
        include 'components/HeroSection.php';
        include 'components/AboutSection.php';
        include 'components/RoomSection.php';
        include 'components/Footer.php';
        break;
}
