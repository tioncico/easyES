<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2018/7/24
 * Time: 15:20
 */

namespace App\HttpController;


use EasySwoole\Config;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;
use FastRoute\RouteCollector;

class Router extends \EasySwoole\Core\Http\AbstractInterface\Router
{
    
    function register(RouteCollector $routeCollector)
    {
        $configs = Config::getInstance()->getConf('web.FAST_ROUTE_CONFIG');
        foreach ($configs as $config){
            $routeCollector->addRoute($config[0],$config[1],$config[2]);
        }
    }
}