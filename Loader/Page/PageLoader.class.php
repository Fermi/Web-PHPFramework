<?php
/**
* FileName: PageLoader.class.php
* Author:   Carl Yu<fxycarl@gmail.com>
* Description: 页面控制器的加载基类文件。
* Date:     Dec 17,2012
*/
require_once dirname(dirname(__FILE__)).'/Config/PageLoaderConfig.php';
class PageLoader{
    //指定默认方法名。
    private $_loadMethodName = 'initPage';
    //公用加载页面方法。
    public function LoadPage($module_name,$page_name){
        if(empty($module_name)||empty($page_name)){
            echo "参数不可用";
            exit;
        }else{
            if(defined("CONTROLLER_MODULE")){
                if(file_exists(CONTROLLER_MODULE.'/'.$module_name.'Page/'.$page_name.'Page.class.php')){
                    require CONTROLLER_MODULE.'/'.$module_name.'Page/'.$page_name.'Page.class.php';
                    if (method_exists($page_name.'Page',$this->_loadMethodName)) {
                        $page_class_name = $page_name.'Page';
                        $page_obj = new $page_class_name;
                        call_user_func(array($page_obj,$this->_loadMethodName));
                        exit;
                    } else {
                        echo "加载页面的方法不存在";
                        exit;
                    }
                } else {
                    echo "您访问的页面不存在";
                    exit;
                }
            } else {
                echo "找不到相应控制器";
                exit;
            }
        }
    }
    
}
