function dijkstra($graph, $start, $destination) {
    $distances = array_fill(0, count($graph), INF);
    $visited = array_fill(0, count($graph), false);
    $distances[$start] = 0;

    for ($i = 0; $i < count($graph); $i++) {
        $minDist = INF;
        $current = -1;

        // find unvisited node with the smallest distance
        for ($j = 0; $j < count($graph); $j++) {
            if (!$visited[$j] && $distances[$j] < $minDist) {
                $minDist = $distances[$j];
                $current = $j;
            }
        }

        if ($current == -1) {
            // no path found
            return null;
        }

        $visited[$current] = true;

        // update distances of neighboring nodes
        for ($j = 0; $j < count($graph); $j++) {
            if ($graph[$current][$j] > 0 && !$visited[$j]) {
                $newDist = $distances[$current] + $graph[$current][$j];
                if ($newDist < $distances[$j]) {
                    $distances[$j] = $newDist;
                }
            }
        }

        if ($current == $destination) {
            // shortest path found
            return $distances[$destination];
        }
    }

    // no path found
    return null;
}


$graph = array(
    array(0, 4, 0, 0, 0, 0, 0, 8, 0),
    array(4, 0, 8, 0, 0, 0, 0, 1, 0),
    array(0, 8, 0, 7, 0, 4, 0, 0, 2),
    array(0, 0, 7, 0, 9, 4, 0, 0, 0),
    array(0, 0, 0, 9, 0, 5, 0, 0, 0),
    array(0, 0, 4, 7, 3, 0, 2, 0, 0),
    array(0, 0, 0, 0, 0, 2, 0, 1, 6),
    array(8, 9, 0, 0, 0, 0, 1, 0, 7),
    array(0, 0, 2, 0, 0, 0, 6, 7, 0)
);

$start = 0;
$destination = 4;

$shortestPath = dijkstra($graph, $start, $destination);

if ($shortestPath === null) {
    echo "No path found.";
} else {
    echo "Shortest path from $start to $destination is $shortestPath.";
}


