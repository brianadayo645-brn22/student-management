<?php

echo "Running Student Management tests...\n";

if (file_exists("app/index.php")) {
    echo "PASS: app/index.php exists\n";
} else {
    echo "FAIL: app/index.php is missing\n";
    exit(1);
}

if (file_exists("app/db.php")) {
    echo "PASS: app/db.php exists\n";
} else {
    echo "FAIL: app/db.php is missing\n";
    exit(1);
}

echo "All tests passed!\n";
