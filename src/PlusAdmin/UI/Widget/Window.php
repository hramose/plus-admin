<?php

namespace PlusAdmin\UI\Widget;

use PlusAdmin\UI\Widget;

class Window extends Widget {

    protected $name = 'html';

    protected $head;

    protected $body;

    public function __construct()
    {
        $this->head = new Widget\Window\Head();
        $this->body = new Widget\Window\Body();
    }

}