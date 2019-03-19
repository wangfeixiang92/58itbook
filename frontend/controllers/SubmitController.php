<?php

namespace frontend\controllers;


use frontend\models\WebSource;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;


class SubmitController extends CommonController
{
    public $layout='submit';



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionWeb()
    {
        $model = new WebSource();
        if(Yii::$app->request->isPost) {
            $model->scenario = 'submit-web';
            $model->resources= UploadedFile::getInstanceByName('resources');
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return $this->render('web', [
                    'error' => reset($model->getErrors())[0],
                    'model' => $model
                ]);
            }

            if(!$model->upload()){
                return $this->render('web', [
                    'error' =>'文件上传失败',
                    'model' => $model
                ]);
            }
            $result = $model->addWebSource();
            if(!$result){
                return $this->render('web', [
                    'error' =>'发布失败',
                    'model' => $model
                ]);
            }
        }
        return $this->render('web',['model'=>$model]);
    }



}
