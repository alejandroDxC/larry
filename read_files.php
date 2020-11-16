<?php

$page_title = 'read files';

include './header.inc';

$data = file('./files/prueba.txt');

// Count the number of items in the array:
$n = count($data);

// Pick a random item:
$rand = rand(0, ($n - 1));

// Print the quotation:
print '<p>' . trim($data[$rand]) . '</p>';

include './footer.inc';
?>