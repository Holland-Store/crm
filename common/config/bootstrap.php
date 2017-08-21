<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@vendor', dirname(dirname(__DIR__)) . '/vendor');
Yii::setAlias('@npm', dirname(dirname(__DIR__)) . '@vendor/npm-asset');
Yii::setAlias('@YiiNodeSocket', '@vendor/ratacibernetica/yii2-node-socket/lib/php');
Yii::setAlias('@nodeWeb', '@vendor/ratacibernetica/yii2-node-socket/lib/js');
