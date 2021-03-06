<?php

namespace backend\controllers;


use backend\models\Upload;
use backend\models\WebSource;
use backend\models\WebSubject;
use common\models\DbWebSource;
use common\models\DbWebSubject;
use common\models\DbWebSubRelation;
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
        $total =  DbWebSource::find()->where(['isDelete'=>0])->count();
        $page = new Pagination(['totalCount' => $total,'pageSize'=>30]);
        $list = DbWebSource::find()
            ->where(['isDelete'=>0])
            ->offset($page->offset)
            ->limit($page->limit)
            ->asArray()
            ->all();
        return $this->render('list',['list'=>$list,'pages'=>$page]);
    }
    /**
     * .web 添加页
     * @return string
     */
    public function actionAdd()
    {
        $model = new WebSource();
        $model->scenario = 'submit-web';
        $subjectList = DbWebSubject::find()->where(['isDelete'=>0])->asArray()->all();
        if(Yii::$app->request->isPost) {
            $model->uId=$this->uId;
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return $this->render('add', [
                    'error' => reset($model->getErrors())[0],
                    'model' => $model,
                    'subjectList'=>$subjectList,
                ]);
            }
            $result = $model->addWebSource();
            if(!$result){
                return $this->render('add', [
                    'error' =>'发布失败',
                    'model' => $model,
                    'subjectList'=>$subjectList,
                ]);
            }
            return $this->redirect(['submit/add']);
        }
        return $this->render('add', [
            'model' => $model,
            'subjectList'=>$subjectList,
        ]);
    }



    /**
     * .web 审核页
     * @return string
     */
    public function actionWeb()
    {
        $model = new WebSource();
        $model->scenario = 'submit-web';
        $id= Yii::$app->request->getQueryParam('id');
        $model->id=$id;
        $info = DbWebSource::find()->where(['id'=>$id])->asArray()->one();
        $subjectList = DbWebSubject::find()->where(['isDelete'=>0])->asArray()->all();
        $firstLevel = DbWebSubRelation::find()->select('subId')->where(['isDelete'=>0,'webId'=>$id,'level'=>0])->asArray()->all();
        $twoLevel = DbWebSubRelation::find()->select('subId')->where(['isDelete'=>0,'webId'=>$id,'level'=>1])->asArray()->all();
        $threeLevel = DbWebSubRelation::find()->select('subId')->where(['isDelete'=>0,'webId'=>$id,'level'=>2])->asArray()->all();
        $webSubjectList[0] = array_column($firstLevel,'subId');
        $webSubjectList[1] = array_column($twoLevel,'subId');
        $webSubjectList[2] = array_column($threeLevel,'subId');
        if(Yii::$app->request->isPost) {
            $model->uId=$this->uId;
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return $this->render('web', [
                    'error' => reset($model->getErrors())[0],
                    'info'=>$info,
                    'model' => $model,
                    'subjectList'=>$subjectList,
                    'webSubjectList'=>$webSubjectList
                ]);
            }
            $result = $model->editWebSource();
            if(!$result){
                return $this->render('web', [
                    'error' =>'发布失败',
                    'info'=>$info,
                    'model' => $model,
                    'subjectList'=>$subjectList,
                    'webSubjectList'=>$webSubjectList
                ]);
            }
            return $this->redirect(['submit/web','id'=>$id]);
        }
        return $this->render('web', [
            'model' => $model,
            'info'=>$info,
            'subjectList'=>$subjectList,
            'webSubjectList'=>$webSubjectList
        ]);
    }


    /*
       * 上传图片
       * */
    public function  actionUpload()
    {

        if (Yii::$app->request->isPost) {
            $model = new Upload();
            $model->img= UploadedFile::getInstanceByName('file');
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return json_encode(['error'=> reset($model->getErrors())[0]]);
            }
            $url = $model->uploadImg();
            if(!$url){
                return json_encode(['error'=> '文件上传失败']);
            }
            return json_encode(['url'=> $url]);
        }
        return json_encode(['error'=> '请求方式非法']);
    }

    /*
 * 上传文件
 * */
    public function  actionUploadResource()
    {

        if (Yii::$app->request->isPost) {
            $model = new Upload();
            $model->resources= UploadedFile::getInstanceByName('file');
            $model->load(Yii::$app->request->post(), '');
            $checkRes = $model->validate();
            if (!$checkRes) {
                return json_encode(['error'=> reset($model->getErrors())[0]]);
            }
            $url = $model->uploadResource();
            if(!$url){
                return json_encode(['error'=> '文件上传失败']);
            }
            return json_encode(['url'=> $url]);
        }
        return json_encode(['error'=> '请求方式非法']);
    }


}
