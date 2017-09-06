<?php

namespace drexlerux\lcswitch;

use yii\bootstrap\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Class for instance LC Switch on any view
 */
class LcSwitch extends InputWidget
{
    public $options = [];

    private $inputId;
    public function init(){
        $this->inputId = Html::getInputId($this->model, $this->attribute);
    }

    public function run(){
        echo Html::activeInput('checkbox', $this->model, $this->attribute, $this->options);
    }


    public function registerScript(){
        $view = $this->getView();
    }
}
