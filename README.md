LC Switch
=========
LC Switch extension for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist drexlerux/yii2-lcswitch "*"
```

or add

```
"drexlerux/yii2-lcswitch": "*"
```

to the require section of your `composer.json` file.


Usage
-----
1. Namespace to use widget class
  ```php
  use drexlerux\lcswitch\LcSwitch;
  ```
2. Once the extension is installed, simply use it in your code by  :
  ```php
  <?= $form->field($model, 'attribute')->widget(LcSwitch::classname(), [
  
  ]); ?>
  ```
