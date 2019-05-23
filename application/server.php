<?php

// 服务启动入口

namespace App;

use FastSwoole\Library\Config;

$server = Config::get("app","type");
require_once ROOT_PATH . "/server/{$server}.php";