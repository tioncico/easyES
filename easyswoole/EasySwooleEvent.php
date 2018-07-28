<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Event\AppEvent;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;

Class EasySwooleEvent implements EventInterface
{
    
    public static function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
        AppEvent::getInstance()->frameInitialize();
        
    }
    
    public static function mainServerCreate(ServerManager $server, EventRegister $register): void
    {
        AppEvent::getInstance()->mainServerCreate($server, $register);
        // TODO: Implement mainServerCreate() method.
    }
    
    public static function onRequest(Request $request, Response $response): void
    {
        AppEvent::getInstance()->onRequest($request, $response);
        // TODO: Implement onRequest() method.
    }
    
    public static function afterAction(Request $request, Response $response): void
    {
        AppEvent::getInstance()->afterAction($request, $response);
        // TODO: Implement afterAction() method.
    }
}