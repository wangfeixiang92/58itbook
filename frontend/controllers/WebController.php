<?php

namespace frontend\controllers;


use frontend\models\WebSource;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;


class WebController extends CommonController
{
    public $layout='list';

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $count=100;
        $pagination = new Pagination(['totalCount' => $count]);
        return $this->render('index',['pagination'=>$pagination]);
    }


    /**
     *  详情页
     * */

    public function actionDetail(){
        $this->layout='web-detail';
        $model = new WebSource();
        $model->load(Yii::$app->request->get('id'), '');
        $checkRes = $model->validate();
        if (!$checkRes) {
            throw new HttpException(404);
        }
        return $this->render('detail');
    }




}
