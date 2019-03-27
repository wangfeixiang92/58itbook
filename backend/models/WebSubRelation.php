<?php

namespace backend\models;

use common\models\DbWebSubRelation;
use Yii;
use yii\base\Model;

/**
 * This is the model class for table "ld_user".
 *
 * @property integer $id
 * @property string $subId
 * @property integer $webId
 * @property integer $isDelete
 * @property integer $level
 */

class WebSubRelation extends Model
{
    public $subId;
    public $webId;
    public $level;


    /*
     * 绑定webId和subjectId的关系
     * */
    public function bindSubjectIds($webId,$subjectIds){

        //删除原来的关系
        $one =  DbWebSubRelation::findOne(['webId'=>$webId]);
        if($one){
            $one->isDelete=1;
            $one->save();
        }
        $db = new DbWebSubRelation();
        //存储当前关系
        if(isset($subjectIds[0])){
          foreach ($subjectIds[0] as $v){
              $db->subId=$v;
              $db->webId=$webId;
              $db->level=0;
              $db->save();
            echo $db->find()->createCommand()->getRawSql();die;
          }
        }
        if(isset($subjectIds[1])){
            foreach ($subjectIds[1] as $v){
                $db->subId=$v;
                $db->webId=$webId;
                $db->level=1;
                $db->save();
            }
        }

        if(isset($subjectIds[2])){
            foreach ($subjectIds[2] as $v){
                $db->subId=$v;
                $db->webId=$webId;
                $db->level=1;
                $db->save();
            }
        }
        return true;
    }

}
