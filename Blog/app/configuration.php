<?php
$json = file_get_contents('./config.json');

$json_data = json_decode($json, true);

print_r();