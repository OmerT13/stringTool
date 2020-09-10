#!/bin/bash

echo 'Welcome to the Stringify Shell Script! We will be running both unit tests to confirm all is well';
php artisan test tests/unit/stringifyTest;
php artisan test tests/unit/stringifyExtTest;