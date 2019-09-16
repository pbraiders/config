<?php

return [

    'application' => [

        // Configure PBRaiders website URL. If PBRaiders is installed into a directory called "pbraiders" for the
        //  domain www.example.com, define ['website']['url'] like this:
        'website' => [
            'url' => 'https://www.example.com/pbraiders/',
        ],

        // Temporary directory.
        'temporary_path' => realpath(\PBR_PATH . \DIRECTORY_SEPARATOR . 'data' . \DIRECTORY_SEPARATOR . 'tmp'),

        // Cache directory. While developping, set it to false to deactivate all caches.
        'cache_path' => realpath(\PBR_PATH . \DIRECTORY_SEPARATOR . 'data' . \DIRECTORY_SEPARATOR . 'cache'),

    ],

    'service' => [

        // Configure container settings.
        'container' => [
            // When a container is configured to be compiled, it will be compiled once and never be regenerated again.
            // That allows for maximum performances in production.
            // When you deploy new versions of your code to production you must delete the generated file
            // (or the directory that contains it) to ensure that the container is re-compiled.
            // @see php-di.org/doc/performances.html
            'enable_compilation' => true,
            'write_proxies_to_file' => true,
        ],

        // Configure database settings.
        'database' => [
            // Database Name used by PBRaiders.
            'name' => 'the_database_name',
            // Username used to access Database.
            'username' => 'the_user_name',
            // Password used by Username to access Database.
            'password' => 'the_password',
            // The hostname of your Database Server. A port number, Unix socket file path or pipe may be needed as well.
            'host' => 'localhost',
            // Driver
            'driver' => 'mysql',
            // Charset
            'charset' => 'utf8mb4',
            // Collation
            'collation' => 'utf8mb4_unicode_ci',
        ],

    ],

    // These are various options for php.
    // Do not change unless you know what you are doing!
    'php' => [

        // Default timezone used by all date/time functions
        'date.timezone' => 'Europe/Paris',

        // Maximum amount of memory in bytes that a script is allowed to allocate.
        'memory_limit' => '40M',

        // This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser.
        'max_execution_time' => '60',

        // Sets which PHP errors are reported.
        'error_reporting' => E_ALL & ~E_DEPRECATED & ~E_STRICT,

        // Determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.
        'display_errors' => '0',

        // Even when display_errors is on, errors that occur during PHP's startup sequence are not displayed.
        // It's strongly recommended to keep display_startup_errors off, except for debugging.
        'display_startup_errors' => '0',

        // Do not log repeated messages.
        'ignore_repeated_errors' => '1',

        // This parameter will show a report of memory leaks detected by the Zend memory manager.
        'report_memleaks' => '0',

        // If enabled, the last error message will always be present in the variable $php_errormsg.
        'track_errors' => '0',

        // If enabled, error messages will include HTML tags.
        'html_errors' => '1',

        // Tells whether script error messages should be logged to the server's error log or error_log.
        'log_errors' => '1',

        // Name of the file where script errors should be logged.
        'error_log' => sprintf('%s/data/log/%s_php_error.log', realpath(\PBR_PATH), date("Ymd")),

        // Session cache expire.
        'session.cache_expire' => '180',

        // Session cache limiter.
        'session.cache_limiter' => '',

        // Domain to set in the session cookie. The app will update this option according to the website url.
        'session.cookie_domain' => '',

        // Marks the cookie as accessible only through the HTTP protocol.
        'session.cookie_httponly' => '1',

        // Lifetime of the cookie in seconds which is sent to the browser.
        'session.cookie_lifetime' => '14400', // 4 hours

        // Path to set in the session cookie.
        'session.cookie_path' => '/',

        // Cookies should only be sent over secure connections.
        // The app will update this option according to the website url.
        'session.cookie_secure' => '',

        // Session name.
        'session.name' => 'PBRAIDERS',

        // Save path. The app will update this option according to the website url.
        'session.save_path' => '/var/lib/php/sessions',

        // Enabling session.use_strict_mode is mandatory for general session security.
        'session.use_strict_mode' => '1',

        // Yhe module will use cookies to store the session id on the client side.
        'session.use_cookies' => '1',

        // Module will only use cookies to store the session id on the client side.
        'session.use_only_cookies' => '1',

        // New protection against cross-site request forgery attacks.
        'session.cookie_samesite' => 'Strict',

        // Length of session ID string.
        'session.sid_length' => '256',

        // Number of bits in encoded session ID character.
        'session.sid_bits_per_character' => '5',
    ],

];
