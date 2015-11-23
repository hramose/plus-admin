<?php

namespace PlusAdmin\UI;

abstract class Widget implements WidgetInterface {

    protected $layout;

    protected $parent;

    protected $children;

    protected $name;

    protected $id;

    protected $class;

    protected $attribute;

    protected $text;

    protected $content;

    public function __construct(WidgetInterface $parent = null)
    {
        $this->parent = $parent;
        $this->children = [];
    }

    public function __destruct()
    {
        $this->children = null;
        $this->parent = null;
    }

    public function name()
    {
        if (null !== $this->name) return $this->name;

        $name = get_called_class();
        if (false !== ($pos = strrpos($name, '\\')))
            $name = substr($name, $pos + 1);

        return ($this->name = $name);
    }

    public function show()
    {
        echo $this->content;
    }

    public function captureShow()
    {
        ob_start();
        $this->show();
        $content = ob_get_contents();
        ob_flush();

        return $content;
    }

}
