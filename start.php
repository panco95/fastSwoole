<?php
// +----------------------------------------------------------------------
// | fastSwoole [ WE CAN FAST MORE AND MORE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://fastSwoole.iorip.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Panco <1129443982@qq.com>
// +----------------------------------------------------------------------

isset($argv[1]) || $argv[1] = "start";
$cmd = $argv[1];

switch ($cmd) {
    case "start":
        require_once __DIR__ . '/loader.php';
        require_once APP_PATH . '/server.php';
        break;
    case "stop":
        $pid_dir = opendir(__DIR__. "/runtime/pids");
        while ($row = readdir($pid_dir)) {
            if ($row == "." || $row == ".." || $row == ".gitkeep") continue;
            $pid_file = __DIR__ . "/runtime/pids/{$row}";
            if (file_exists($pid_file)) {
                $pid = file_get_contents($pid_file);
                exec("kill -9 {$pid}");
                unlink($pid_file);
                echo "{$row } server is stop!\n";
            } else {
                echo "{$row} server is not run!\n";
            }
        }
        break;
}