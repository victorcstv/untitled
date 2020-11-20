<?php
    session_start();

    require_once 'config/config.php';
    require_once 'url.php';

    
    require_once $folder . '/components/header.php';

    require_once $folder . '/' . $control . '.php';

    require_once $folder . '/components/footer.php';