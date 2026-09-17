<?php
$tableau = ["PHP 8", "Docker", "SQL", "Scrum", "Git", "Symfony"];

echo count($tableau) . "\n";
for ($i=0; $i < count($tableau); $i++) { 
    echo $i+1 . ". " . $tableau[$i] . "\n";
}
sort($tableau);
echo "\n";
for ($i=0; $i < count($tableau); $i++) { 
    echo $i+1 . ". " . $tableau[$i] . "\n";
}
echo end($tableau) . "\n";
?>