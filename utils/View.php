<?php


class View
{
    private $data = array();

    private $render = FALSE;

    /**
     * View constructor.
     * @param $template
     */
    public function __construct($template)
    {
        try {
            $file = 'Views/' . strtolower($template) . '.php';
            if (file_exists($file)) {
                $this->render = $file;
            } else {
                throw new Exception('Template ' . $template . ' not found!');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $variable
     * @param $value
     */

    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    /**
     * View destructor
     */
    public function __destruct()
    {
        extract($this->data);
        include($this->render);

    }
}


