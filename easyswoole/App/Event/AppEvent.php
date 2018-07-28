<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2018/7/20
 * Time: 10:52
 */

namespace App\Event;

use EasySwoole\Config;
use EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;
use EasySwoole\Core\Swoole\EventRegister;
use EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\AbstractInterface\Singleton;
use EasySwoole\Core\Utility\File;
use Think\Db;

class AppEvent implements EventInterface
{
    use Singleton;

    public static function frameInitialize(): void
    {
        // 载入项目 Conf 文件夹中所有的配置文件
        self::loadConf(EASYSWOOLE_ROOT . '/Config');
        self::loadConf(EASYSWOOLE_ROOT . '/App/Config');
        self::loadDB();
        include_once EASYSWOOLE_ROOT . "/App/Base/function.php";//通用函数库
        define('HTTP_ROOT', Config::getInstance()->getConf('web.WEB_URL'));
    }

    public static function mainServerCreate(ServerManager $server, EventRegister $register): void
    {

    }

    public static function onRequest(Request $request, Response $response): void
    {
    }

    public static function afterAction(Request $request, Response $response): void
    {
        unset($GLOBALS);
        unset($_GET);
        unset($_POST);
        unset($_SESSION);
        unset($_COOKIE);
    }

    public static function loadDB()
    {
        // 获得数据库配置
        $dbConf = Config::getInstance()->getConf('database');
        // 全局初始化
        Db::setConfig($dbConf);
    }

    public static function loadConf($ConfPath)
    {
        $Conf  = Config::getInstance();
        $files = File::scanDir($ConfPath);
        if (!is_array($files)) {
            return;
        }
        foreach ($files as $file) {
            $data = require_once $file;
            $Conf->setConf(strtolower(basename($file, '.php')), (array)$data);
        }
    }

}