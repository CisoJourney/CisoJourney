<?php
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Strict-Transport-Security: max-age=15552000; includeSubDomains");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Content-Security-Policy: style-src 'self' https://fonts.googleapis.com https://use.fontawesome.com; font-src 'self' https://fonts.gstatic.com https://use.fontawesome.com;");
?>
