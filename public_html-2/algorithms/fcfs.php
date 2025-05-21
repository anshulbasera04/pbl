<?php
function fcfs_handler($cmd) {
    $parts = explode(' ', $cmd);
    array_shift($parts);

    $processes = [];
    for ($i = 0; $i < count($parts); $i += 3) {
        $processes[] = ['name' => $parts[$i], 'arrival' => (int)$parts[$i + 1], 'burst' => (int)$parts[$i + 2]];
    }
    usort($processes, fn($a, $b) => $a['arrival'] <=> $b['arrival']);
    $time = 0;
    $chart = [];
    $table = [];
    $ready_queue = $processes;
    $total_waiting = 0;
    $total_turnaround = 0;

    foreach ($processes as $p) {
        $start = max($time, $p['arrival']);
        $end = $start + $p['burst'];
        $waiting = $start - $p['arrival'];
        $turnaround = $end - $p['arrival'];

        $chart[] = ['name' => $p['name'], 'start' => $start, 'end' => $end];
        $table[] = ['name' => $p['name'], 'arrival' => $p['arrival'], 'burst' => $p['burst'], 'start' => $start, 'end' => $end, 'waiting' => $waiting, 'turnaround' => $turnaround];
        $time = $end;
        $total_waiting += $waiting;
        $total_turnaround += $turnaround;
    }

    return json_encode([
        'type' => 'fcfs',
        'chart' => $chart,
        'summary' => [
            'avg_waiting' => round($total_waiting / count($processes), 2),
            'avg_turnaround' => round($total_turnaround / count($processes), 2)
        ],
        'table' => $table,
        'ready_queue' => $ready_queue
    ]);
}
?>