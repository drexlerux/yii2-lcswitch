<?php

namespace drexlerux\lcswitch;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Class for instance LC Switch on any view
 */
class LcSwitch extends InputWidget
{
    public $options = [];
    public $events = [];
    private $inputId;
    public function init(){
        $defaultsOptions = [
            'on_text' => Yii::t('app', 'Yes'),
            'of_text' => Yii::t('app', 'No'),
        ];

        $this->options = array_merge($defaultsOptions, $this->options);

        $this->inputId = Html::getInputId($this->model, $this->attribute);
    }

    public function run(){
        $this->registerScript();
        $hidden = Html::activeHiddenInput($this->model, $this->attribute, ['id'=>'hidden_'.$this->inputId]);
        $input = Html::activeInput('checkbox', $this->model, $this->attribute, $this->options);
        echo "<div id='container-$this->inputId'>". $hidden . $input ."</div>";
    }


    public function registerScript(){
        $view = $this->getView();
        $asset = LcSwitchAsset::register($view);
        extract($this->options);
        $js = "
            $(document).on('ready', function(){
                $('#$this->inputId').lc_switch('$on_text', '$of_text');
            });
        ";

        if(isset($this->events['lcs-init'])){
            $callback =  $this->events['lcs-init'];
            $js .= "($callback)($('#$this->inputId'));";
        }

        if(isset($this->events['lcs-statuschange'])){
            $callback =  $this->events['lcs-statuschange'];
            $js .= "
                $('body').delegate('#$this->inputId', 'lcs-statuschange', $callback);
            ";
        }

        if(isset($this->events['lcs-on'])){
            $callback =  $this->events['lcs-on'];
            $js .= "
                $('body').delegate('#$this->inputId', 'lcs-on', $callback);
            ";
        }

        if(isset($this->events['lcs-off'])){
            $callback =  $this->events['lcs-off'];
            $js .= "
                $('body').delegate('#$this->inputId', 'lcs-off', $callback);
            ";
        }

        $css = "";
        if(isset($this->options['width'])){
            $css .= "
                #container-$this->inputId .lcs_switch{
                    width: $width !important;
                }
            ";
        }

        $css .= "
            .lcs_switch.lcs_on .lcs_cursor {
                right: 3px !important;
                left: auto !important;
            }

            .lcs_label{
                width: 100% !important;
            }

            .lcs_switch.lcs_on .lcs_label_on {
                left: -10px !important;
            }

            .lcs_switch.lcs_off .lcs_label_off {
                left: 10px !important;
                right: auto !important;
            }
        ";



        $view->registerJs($js);
        $view->registerCss($css);
    }
}
