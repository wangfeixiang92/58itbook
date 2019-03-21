<?php
/**
 *  邮件发送model
 *
 * */
namespace backend\models;

use common\models\DbWebSource;
use Yii;
use yii\base\Model;
/**
 * LoginForm is the model behind the login form.
 *
 */



class WebSubject extends Model
{
    public $id;
    public $name;
    public $sort;
    public $pid;
    public $level;
    public $isDelete;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
                return [
                    ['id','required', 'message' => 'id不合法','on'=> ['delete','edit']],
                    ['id','integer', 'message' => 'id不合法','on'=> ['delete','edit']],
                    [['name'], 'string', 'min' => 2, 'max' => 20,'message' => '标题长度必须大于2个字符,小于20个字符','on'=> 'edit'],
                    ['sort','integer', 'message' => '排序请输入数字','on'=> ['edit']],
                ];

    }

    /**
     * 验证文件
     * */
    public function validateResources($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(!in_array(trim($this->resources->type),['application/x-zip-compressed','application/octet-stream']) || !in_array(trim($this->resources->extension),['zip', 'rar'])){
                $this->addError('error','上传的文件格式错误');
            }
            if($this->resources->size > 30*1024*1024){
                $this->addError('error','所上传文件的大小不得大于30M');
            }
            return true;
        }
    }

    /*
     * 验证文件
     * */
    public function validateCkeditorImg($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(!in_array(trim($this->img->type),['image/gif','image/jpeg','image/gif','image/png']) || !in_array(trim($this->img->extension),['png','jpg','jpeg','gif'])){
                $this->addError('error','上传的文件格式错误');
            }
            if($this->img->size > 5*1024*1024){
                $this->addError('error','所上传文件的大小不得大于5M');
            }
            return true;
        }
    }



    public function addWebSource()
    {
        $source = new DbWebSource();
        $source->uId = $this->uId;
        $source->title = $this->title;
        $source->keyword = $this->keyword;
        $source->describe = $this->describe;
        $source->manual = $this->manual;
        $source->oldUrl = $this->oldUrl;
        $source->soureUrl=$this->soureUrl;
        $source->previewUrl=Yii::$app->params['upload']['webPrewiew'].basename($this->soureUrl);
        $source->updateTime = time();
        $source->registerTime = date('Y-m-d H:i:s',time());
        $source->price = $this->price;
        $result = $source->save();
        if($result){
            (new EveryDayData())->addSubmitWebNum();
        }
        return $result;
    }


    /**
     * 上传文件
     * */
    public function upload()
    {
          $path =Yii::$app->params['upload']['web'].'/'.date('ymd',time()).'/';
        if ( !is_dir($path)) {
             mkdir($path, 0777, true);
            chmod($path, 0777);
        }
        if ($this->validate()) {
            //生成文件名
            $fileName =rand(100000, 999999). '.'.$this->resources->extension;
            $this->soureUrl =$path.$fileName;
            if(!$this->resources->saveAs($this->soureUrl)){
                return false;
            }
        } else {
            //上传失败记录日志
            Yii::info($this->errors, $this->resources, 'Upload');
            return false;
        }
        return   $this->soureUrl;
    }


    /**
     * 上传文件
     * */
    public function uploadCkeditorImg()
    {
        $path =Yii::$app->params['ueditorImg'].'/'.date('ymd',time()).'/';
        if ( !is_dir($path)) {
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }
        if ($this->validate()) {
            //生成文件名
            $fileName =rand(100000, 999999). '.'.$this->img->extension;
            $this->soureUrl =$path.$fileName;
            if(!$this->img->saveAs($this->soureUrl)){
                return false;
            }
        } else {
            //上传失败记录日志
            Yii::info($this->errors, $this->img, 'Upload');
            return false;
        }
        return   $this->soureUrl;
    }




}