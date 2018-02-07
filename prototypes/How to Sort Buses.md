# Prototype By Daison Carino

#### Sample Array

```
$array = [
    ['89e', 62, 80, 82, 87, 89, 27, 325, 113, 161],
    ['89e', 51, 74, '74e', 89, 27, 324, 325, 102, 107, '107M', 112, 113, 116, 132, 147, 151, '151e', 153, 161, 165],
    [51, 72, 80, 325, 101, 119, 132, 136, 153],
    [51, 72, 80, 325, 101, 119, 132, 136, 153],
    [80, 81, 82, 101, 107, '107M', 112, 113, 119, 136, 153],
    [80, 81, 82, 101, 107, '107M', 112, 113, 119, 136, 153],
    [80, 81, 82, 101, 107, '107M', 112, 113, 136, 153],
    [80, 81, 82, 101, 107, '107M', 136, 153],
    [80, 81, 82, 101, 107, '107M', 136, 153],
    [43, 45, 53, '53M', 58, '58A', 70, '70M', 22, 317, 101, 103, 107, '107M', 116, 153],
    ['NR6', 45, 58, '58A', 853, '853C', 317, 101, 103, 107, '107M', 147, 153],
    ['NR6', 853, '853C', 100, 107, '107M', 133, 135, 147, 153],
    ['NR6', 853, '853C', 100, 107, '107M', 133, 135, 147, 153],
    [93, 28, 153],
    [93, 28, 13, 153, 155, '155A'],
    [93, 28, 129, 13, 153, 155, '155A'],
    [93, 73, 28, 105, 129, 13, 153, 155, '155A', 159],
    [93, 'NR1', 73, 28, 105, 129, 13, 153, 155, '155A', 159],
    ['NR1', 56, 57, 59, 73, 88, 28, 105, 129, 153, 155, '155A', 157, 159, 163],
    ['NR1', 56, 73, 88, 28, 105, 153, 155, '155A', 157, 159, 163],
    ['NR1', 56, 105, 153],
    ['NR1', 56, 105, 129, 153],
    [966, 985, 'NR1', 5, 506, 56, 57, 105, 129, 139, '139M', 143, 145, 151, '151e', 153, 154],
    [966, 985, 105, 132, 151, 153, 154, 156, 186],
    [966, 985, 105, 132, 151, 153, 154, 156, 186],
    [966, 973, 700, '700A'],
    [966, 973, 700, '700A'],
    [966, 973, 700, '700A'],
    [966, 973, 700, '700A'],
    [960, 963, '963E', '963R', 966, 973, 700, '700A', 171, 184],
    [960, 963, '963E', '963R', 75, 171],
    [960, 963, '963E', '963R', 75, 171],
    [920, 922, 960, 963, '963E', '963R', 970, 979, '979M', 983, 75, 171],
    [920, 922, '971E', 972, '972A'],
    [920, 972, '972A', 'BPS1'],
];
```

#### Count the array which is 13 indexes

#### Call Loop Counter:
    89e => 2, 27 => 2, 89 => 2, 325 => 4, 113 => 2, 161 => 2
        ===> 325 => 4 ~ Go to 4th index

#### Check if (4th index) - 0) >= 13 max index, then terminate, else loop to 4th index

#### Call Loop Counter:
    80 => 6, 101 => 8, 119 => 3, 136 => 6, 153 => 21
        ===> 153 => 10 ~ Go to 4 + 10

#### Check if ((4th + 10th) - 1) >= 13 max index, then terminate, else loop to 4th index

# Code

```
$finals = [];
$skipLoop = 0;

foreach ($array as $latLng => $buses) {
    if ($skipLoop > 0) {
        --$skipLoop;

        continue;
    }

    $scores = [];
    $ignored = [];

    foreach ($buses as $bus) {
        $scores[$bus] = 1;

        foreach ($array as $latLng2 => $buses2) {
            if ($latLng >= $latLng2) {
                continue;
            }

            if ($latLng2-1 > 0 && in_array($bus, $array[$latLng2-1], true) === false) {
                $ignored[] = $bus;

                continue;
            }

            if (in_array($bus, $ignored, true) !== false) {
                continue;
            }

            if (in_array($bus, $buses2, true) !== false) {
                $scores[$bus] = isset($scores[$bus]) ? $scores[$bus] + 1 : 1;
            }
        }
    }

    $maxKeys = array_keys($scores, max($scores));
    $maxValue = $scores[reset($maxKeys)]; # get first index

    $finals[$latLng] = [
        'buses' => $maxKeys,
        'bus_stops' => $maxValue,
    ];

    $totalBusStops = array_sum(array_map(function($arr) {
        return $arr['bus_stops'];
    }, $finals));

    $loopCounts = (count($finals) - 1);

    if (($totalBusStops - $loopCounts) >= count($array)) {
        break;
    }

    # since `continue $variable` was removed in php 5.4.0, we need to pass it on top
    $skipLoop = ($totalBusStops - 1) - ($latLng + 1);
}

var_dump($finals);
```
