
<?php
sleep(1); // Met en pause le script 3 secondes
$sentences = [
    'Hello world!',
    'Great server',
    'Amazing ajax request',
    'A random sentence'
];
echo $sentences[array_rand($sentences)];