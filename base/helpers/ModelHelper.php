<?php


namespace app\helpers;

use yii\web\NotFoundHttpException;

class ModelHelper
{
    public static function findModel($modelClass, $id)
    {
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
