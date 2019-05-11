<?php
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Strict-Transport-Security: max-age=15552000; includeSubDomains");
header("Referrer-Policy: strict-origin-when-cross-origin");
// Had to add cisojourney.com as a font-src because Firefox is a moron and 'self' doesn't work
header("Content-Security-Policy: font-src 'self' https://cisojourney.com https://fonts.gstatic.com https://use.fontawesome.com; style-src 'self' https://fonts.googleapis.com https://use.fontawesome.com;");
?>
