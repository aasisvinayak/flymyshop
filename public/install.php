<?php



$envSample = '.env.example';
$env = '.env';

if (!copy($envSample, $env)) {
    echo 'Error occurred. Please check that the directory has write permissions ';
}


class Shop
{
}
