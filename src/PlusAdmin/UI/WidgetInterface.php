<?php

namespace PlusAdmin\UI;

interface WidgetInterface {

    public function layout();
    public function parent();
    public function children();

    public function addChild();
    public function setLayout();
    public function setParent();
    public function setChildren();

    public function show();

}