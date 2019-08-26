<?php
function test($test) {
    if (empty($test)) echo "empty";
    else echo $test;
}

test('');