<?php

namespace backend\controllers;


use backend\models\WebSubject;
use common\models\DbWebSubject;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;


class WebSubjectController extends CommonController
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
        $map['isDelete']=0;
        $pid = Yii::$app->request->get('pid');
        $id =  Yii::$app->request->get('id');
        $pid &&  $map['pid'] = $pid;
        $id &&  $map['id'] = $id;
        $pInfo=[];
        if($pid){
            $pInfo = DbWebSubject::findOne(['id'=>$pid]);
        }
        $this->page->current=Yii::$app->request->get('page') ? Yii::$app->request->get('page') :1;
        $this->page->total =  DbWebSubject::find()->where($map)->count();
        $list = DbWebSubject::find()
            ->where($map)
            ->offset(($this->page->current-1)*$this->page->length)
            ->limit($this->page->length)
            ->asArray()
            ->all();
        foreach ($list as &$v ){
            $v['pname'] = $v['pid'] == 0 ? '':DbWebSubject::getNameById($v['pid']);
        }
        return $this->render('list',['list'=>$list,'page'=>$this->page,'info'=>$pInfo]);
    }


    /*
     * 添加子分类
     * */
    public function actionAddChildSubject(){
        $model = new WebSubject();
        $agreement = Yii::$app->params['web-agreement'];
        $id= Yii::$app->request->get('id');
        $pInfo = DbWebSubject::findOne(['id'=>$id]);
        if(Yii::$app->request->isPost) {
            $model->scenario = 'addChild';
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return $this->render('child', [
                    'info'=>$pInfo,
                    'model'=>$model,
                    'error' => reset($model->getErrors())[0],
                ]);
            }
            $result = $model->addSubject();
            if(!$result){
                return $this->render('child', [
                    'info'=>$pInfo,
                    'model'=>$model,
                    'error' => reset($model->getErrors())[0],
                ]);
            }
        }
        return $this->render('child', [
            'info'=>$pInfo,
            'model'=>$model,
            'error' => reset($model->getErrors())[0],
        ]);
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
