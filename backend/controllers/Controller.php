<?php


class Controller
{
    //chứa nội dung view
    public $content;
    //chứa nội dung lỗi validate
    public $error;

    /**
     * @param 
     * @param array 
     * @return false|string
     */
    public function render($file, $variables = []) {

        
        extract($variables);
        
        ob_start();
        
        require_once $file;
        
        $render_view = ob_get_clean();

        return $render_view;
    }
}