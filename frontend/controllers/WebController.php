<?php

namespace frontend\controllers;


use common\models\CommonHelper;
use common\models\DbUser;
use common\models\DbWebSource;
use common\models\DbWebSubject;
use common\models\DbWebSubRelation;
use frontend\models\WebSource;
use frontend\models\webSubject;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;


class WebController extends CommonController
{
    public $layout='index';


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userTable = DbUser::tableName();
        $subjectRelation = DbWebSubRelation::tableName();
        $subjectObj = new webSubject();
        $subjectObj->load(Yii::$app->request->queryParams, '');
        $checkRes = $subjectObj->validate();
        if (!$checkRes) {
            throw new HttpException(404);
        }
        //获取科目
        $webSubject = $subjectObj->getSubjectList();

        //查询数据
        $map['s.status']=1;
        $map['s.isDelete']=0;
        $map['l.subId']=$subjectObj->subjectId;

        $total =DbWebSource::find()
            ->alias('s')
            ->join('left join',"$userTable u",'s.uId = u.uId')
            ->join('left join',"$subjectRelation l","s.id = l.webId")
            ->select('s.*,u.userName')
            ->where($map);
        $subjectObj->orderBy ? $total = $total->orderBy([$subjectObj->orderBy=>SORT_DESC])->count() : $total->count();

        $webList = DbWebSource::find()
            ->alias('s')
            ->join('left join',"$userTable u",'s.uId = u.uId')
            ->join('left join',"$subjectRelation l","s.id = l.webId")
            ->select('s.*,u.userName')
            ->where($map);
        $subjectObj->orderBy ? $webList = $webList->orderBy([$subjectObj->orderBy=>SORT_DESC])->offset(($subjectObj->page-1)*$subjectObj->offset)->limit($subjectObj->offset)->asArray()->all():$webList = $webList->offset(($subjectObj->page-1)*$subjectObj->offset)->limit($subjectObj->offset)->asArray()->all();
        foreach ($webList as &$v){
            $v['registerDate'] = CommonHelper::getRegisetrDate($v['registerTime']);
            $v['analysisBrowseNum']=CommonHelper::getAnalysisNum($v['browseNum']);
            $v['analysisDownloadNum']=CommonHelper::getAnalysisNum($v['downloadNum']);
        }
        return $this->render('index',['subjectObj'=>$subjectObj,'webList'=>$webList,'total'=>$total]);
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
