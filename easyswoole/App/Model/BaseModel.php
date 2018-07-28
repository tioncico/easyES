<?php

namespace App\Model;

use App\Base\Tool;
use EasySwoole\Core\AbstractInterface\Singleton;
use think\Db;
use think\Model;

/**
 * 基类model
 */
Class BaseModel extends Model
{
    use Tool;
    
    public function __construct($name = '')
    {
        !empty($name) && $this->name = $name;
        parent::__construct();
    }
}
