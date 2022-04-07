<?php
class Controller
{
    function displayView($model)
    {
        $dir = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        $dir = strtolower($dir);
        $view = strtolower($view);
        ob_start();
        require __DIR__ . "/../views/$dir/$view.php";
        $content = ob_get_clean();

        $layout = $this->getLayout('layout');
        return str_replace("{{content}}", $content, $layout);
    }

    function displayViewOnly()
    {
        $model = null;
        $dir = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        $dir = strtolower($dir);
        $view = strtolower($view);
        ob_start();
        require __DIR__ . "/../views/$dir/$view.php";
        $content = ob_get_clean();

        $layout = $this->getLayout('layout');
        return str_replace("{{content}}", $content, $layout);
    }

    //Display view for the admin page.
    function displayAltView($model)
    {
        $dir = debug_backtrace()[1]['class'];
        $dir = substr($dir, 12);
        $dir  = substr($dir, 0, -10);
        $view = debug_backtrace()[1]['function'];


        ob_start();
        require __DIR__ . "/../views/$dir/$view.php";
        $content = ob_get_clean();

        $layout = $this->getLayout('altLayout');
        return str_replace("{{content}}", $content, $layout);
    }
    function displayAltViewOnly()
    {
        $model = null;
        $dir = debug_backtrace()[1]['class'];
        $dir = substr($dir, 12);
        $dir  = substr($dir, 0, -10);
        $view = debug_backtrace()[1]['function'];

        ob_start();
        require __DIR__ . "/../views/$dir/$view.php";
        $content = ob_get_clean();

        $layout = $this->getLayout('altLayout');
        return str_replace("{{content}}", $content, $layout);
    }

    function getLayout($file)
    {
        ob_start();
        require_once __DIR__ . '/../views/' . $file . '.php';
        return ob_get_clean();
    }
}
