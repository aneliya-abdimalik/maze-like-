
<?php
error_reporting(0);
echo "\n\n\nEnter row and column: \n";
 
// Right trim fgets(user input)
$dimention1 = rtrim(fgets($stdin));
 
// Right trim fgets(user input)
$dimention2 = rtrim(fgets($stdin));
 
echo "Entered row and column: " .
    $dimention1 . "x" . $dimention1 . " \n";
 
$maze_arr = [];
$k = 0;
 
for ($row = 0; $row < $dimention1; $row++) {
    for ($col = 0; $col < $dimention2; $col++) {
        $maze_arr[$row][$col]= $k++;
    }
}


//the start and the end
$start_point = 1;
$end_point = 5;

//initialize the array for storing
$S = array();//the nearest path with its parent and weight
$Q = array();//the left nodes without the nearest path
foreach(array_keys($maze_arr) as $val) $Q[$val] = 99999;
$Q[$start_point] = 0;

//start calculating
while(!empty($Q)){
    $min = array_search(min($Q), $Q);//the most min weight
    if($min == $end_point) break;
    foreach($maze_arr[$min] as $key=>$val) if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
        $Q[$key] = $Q[$min] + $val;
        $S[$key] = array($min, $Q[$key]);
    }
    unset($Q[$min]);
}

//list the path
$path = array();
$pos = $end_point;
while($pos != $start_point){
    $path[] = $pos;
    $pos = $S[$pos][0];
}
$path[] = $start_point;
$path = array_reverse($path);

//print result
echo "<br />From $start_point to $end_point";
echo "<br />The length is ".$S[$end_point][1];
echo "<br />Path is ".implode('->', $path);
?>
