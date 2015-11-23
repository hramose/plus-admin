<?php

namespace PlusAdmin\UI\Widget\Window;

use PlusAdmin\UI\Widget\Window;

class MainWindow extends Window {

    /**
     * @var \PlusAdmin\UI\Widget\Window\Menu
     */
    protected $menu;

    /**
     * @var \PlusAdmin\UI\Widget\Window\Sidebar
     */
    protected $sidebar;

    /**
     * @var \PlusAdmin\UI\Widget\Window\Main
     */
    protected $main;

    public function __construct(WidgetInterface $parent = null)
    {
        parent::__construct($parent);

        $this->menu = new Menu();
        $this->sidebar = new Sidebar();
        $this->main = new Main();

        $this->setLayout("<NAME>...</NAME>");
    }

    public function __destruct()
    {
        $this->menu = null;
        $this->sidebar = null;
        $this->main = null;

        parent::__destruct();
    }

}