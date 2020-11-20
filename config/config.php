<?php
    require_once 'lib/Database.php';

    define("SITE_URL", "http://localhost:80/");
        
    
    define("DB_TYPE", "mysql");
    define("HOST", "localhost");
    define("PORT", "3307");
    define("USER", "root");
    define("PASSWORD", "docker");
    define("DB", "untitled");

    $connect = new Database(
        DB_TYPE,
        HOST,
        PORT,
        USER,
        PASSWORD,
        DB
    );