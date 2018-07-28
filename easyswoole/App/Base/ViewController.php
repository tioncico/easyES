<?php

namespace App\Base;

use EasySwoole\Config;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;
use EasySwoole\Core\Http\Session\Session;
use think\Template;

/**
 * 视图控制器
 * Class ViewController
 * @author  : evalor <master@evalor.cn>
 * @package App
 */
abstract class ViewController extends Controller
{
    private $view;
    
    /**
     * 初始化模板引擎
     * ViewController constructor.
     * @param string   $actionName
     * @param Request  $request
     * @param Response $response
     */
    public function __construct(string $actionName, Request $request, Response $response)
    {
        $this->init($actionName, $request, $response);
//        var_dump($this->view);
        parent::__construct($actionName, $request, $response);
    }
    
    /**
     * 输出模板到页面
     * @param  string|null $template 模板文件
     * @param array        $vars 模板变量值
     * @param array        $config 额外的渲染配置
     * @author : evalor <master@evalor.cn>
     */
    public function fetch($template=null, $vars = [], $config = [])
    {
        ob_start();
        $template==null&&$template=$GLOBALS['base']['ACTION_NAME'];
        $this->view->fetch($template, $vars, $config);
        $content = ob_get_clean();
        $this->response()->write($content);
    }
    
    /**
     * @return Template
     */
    public function getView(): Template
    {
        return $this->view;
    }
    
    public function init(string $actionName, Request $request, Response $response)
    {
        $this->view             = new Template();
        $tempPath               = Config::getInstance()->getConf('TEMP_DIR');     # 临时文件目录
        $class_name_array       = explode('\\', static::class);
        $class_name_array_count = count($class_name_array);
        $controller_path
                                = $class_name_array[$class_name_array_count - 2] . DIRECTORY_SEPARATOR . $class_name_array[$class_name_array_count - 1] . DIRECTORY_SEPARATOR;
//        var_dump(static::class);
        $this->view->config([
                                'view_path' => EASYSWOOLE_ROOT . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $controller_path,
                                # 模板文件目录
                                'cache_path' => "{$tempPath}/templates_c/",               # 模板编译目录
                            ]);
        
//        var_dump(EASYSWOOLE_ROOT . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $controller_path);
    }
    
}