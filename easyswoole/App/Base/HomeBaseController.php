<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2018/7/20
 * Time: 16:06
 */

namespace App\Base;

use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;

class HomeBaseController extends BaseController
{
    
    public function __construct(string $actionName, Request $request, Response $response)
    {
        parent::__construct($actionName, $request, $response);
    }
    
    public function init($actionName, $request, $response)
    {
        parent::init($actionName, $request, $response);
        $_SESSION['user'] = $this->session($request, $response)->get('user');
        $this->getView()->assign('session', $_SESSION['user']);
    }

}