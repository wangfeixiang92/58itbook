<?php

namespace backend\controllers;


use backend\models\WebSource;
use common\models\DbWebSource;
use common\models\DbWebSubject;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;


class SubmitController extends CommonController
{

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
//        if(!$this->uId){
//            return $this->redirect('login.html');
//        }
    }
    /*
     * *
     * web 审核页面
     * */
    public function actionList(){
        $total =  DbWebSource::find()->where(['status'=>0,'isDelete'=>0])->count();
        $page = new Pagination(['totalCount' => $total,'pageSize'=>30]);
        $list = DbWebSource::find()
            ->where(['status'=>0,'isDelete'=>0])
            ->offset($page->offset)
            ->limit($page->limit)
            ->asArray()
            ->all();
        return $this->render('list',['list'=>$list,'pages'=>$page]);
    }

    /*
   *  分类管理
   * */
    public function actionSubject(){
        $total =  DbWebSubject::find()->where(['isDelete'=>0])->count();
        $page = new Pagination(['totalCount' => $total,'pageSize'=>30]);
        $list = DbWebSubject::find()
            ->where(['isDelete'=>0])
            ->offset($page->offset)
            ->limit($page->limit)
            ->asArray()
            ->all();
        return $this->render('subject',['list'=>$list,'pages'=>$page]);
    }




    /**
     * .web 发布页
     * @return string
     */
    public function actionWeb()
    {
        $model = new WebSource();
        $agreement = Yii::$app->params['web-agreement'];
        $model->scenario = 'edit';
        $id= Yii::$app->request->get('id');
        $model->id=$id;
        $checkRes = $model->validate();
        if (!$checkRes) {
            return $this->render('web', [
                'error' => reset($model->getErrors())[0],
                'model' => $model,
                'agreement'=>$agreement
            ]);
        }

        $info = DbWebSource::find()->where(['id'=>$id])->asArray()->one();
        if(Yii::$app->request->isPost) {
            $model->scenario = 'submit-web';
            $model->resources= UploadedFile::getInstanceByName('resources');
            $model->uId=$this->uId;
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return $this->render('web', [
                    'error' => reset($model->getErrors())[0],
                    'model' => $model,
                    'agreement'=>$agreement,
                ]);
            }

            if(!$model->upload()){
                return $this->render('web', [
                    'error' =>'文件上传失败',
                    'model' => $model,
                    'agreement'=>$agreement
                ]);
            }

            $result = $model->addWebSource();
            if(!$result){
                return $this->render('web', [
                    'error' =>'发布失败',
                    'model' => $model,
                    'agreement'=>$agreement
                ]);
            }
            return $this->redirect('submitweb.html');
        }

        return $this->render('web', [
            'model' => $model,
            'agreement'=>$agreement,
            'info'=>$info
        ]);
    }

    /*
     * 富文本上传图片
     * */
    public function  actionUeditorImg()
    {
        if (Yii::$app->request->isPost) {
            $model = new WebSource();
            $model->scenario = 'ckeditor-img';
            $model->img= UploadedFile::getInstanceByName('upload');
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return json_encode(['error'=> reset($model->getErrors())[0]]);
            }

            if(!$model->uploadCkeditorImg()){
                return json_encode(['error'=> '文件上传失败']);
            }

            return json_encode(['url'=> $model->soureUrl]);
        }
        return json_encode(['error'=> '请求方式非法']);
    }

}
