<?php 

namespace dopler_core;


abstract class Controller
{
    public string|false $layout = '';
    public string|false $view = '';
    public $model;
    public array $data = array();
    public array $meta = [
        'title' => '',
        'description' => '',
        'keywords' => ''
    ];

    public function __construct(public array $route = array())
    {

    }
    public function get_model()
    {
        $model = 'app\models\\'
        . $this->route['admin_prefix'] 
        . $this->route['controller'];
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }
    public function getView()
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))
        ->render($this->data);
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMeta(string $title = '', string $description = '', string $keywords = '')
    {
        $this->meta = [
            'title' => App::$app->getProperty('site_name') . '::' . $title,
            'description' => $description,
            'keywords' => $keywords,
        ];
    }
}

?>