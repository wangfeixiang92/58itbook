<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;


class SiteController extends CommonController
{
    public $layout='index';

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     *
     *
     *
     * */

    public function actionMaterial()
    {

        return $this->render('material');
    }

    public function actionDetail()
    {
        return $this->render('detail');
    }

    /**
     *  协议
     *
     * */
    public function actionAgreement()
    {
        return $this->render('agreement');
    }




    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



    public function actionPhpinfo(){
        echo phpinfo();die;
    }
}
