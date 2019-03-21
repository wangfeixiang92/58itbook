<?php

namespace backend\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;


class   CommonController extends Controller
{
    public $uId;
    public $userInfo=[];
    public function init()
    {
        $userInfo =json_decode(Yii::$app->session->get(Yii::$app->params['redisUserinfoKey']),true);
        $this->uId =$userInfo['uId'];
        $this->userInfo =$userInfo;
        Yii::$app->view->params['userInfo']=$userInfo;
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     *  404页面
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


}
