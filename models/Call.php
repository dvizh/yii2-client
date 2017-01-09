<?php
namespace pistol88\client\models;

use Yii;
use yii\helpers\Url;
use pistol88\client\models\call\CallQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;

class Call extends \yii\db\ActiveRecord
{
    function behaviors()
    {
        return [
            'field' => [
                'class' => 'pistol88\field\behaviors\AttachFields',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    public static function tableName()
    {
        return '{{%client_call}}';
    }
    
    public static function Find()
    {
        $return = new CallQuery(get_called_class());
        $return = $return->with('category');
        
        return $return;
    }
    
    public function rules()
    {
        return [
            [['client_id', 'time'], 'required'],
            [['category_id', 'client_id', 'staffer_id'], 'integer'],
            [['comment', 'result', 'status', 'matter', 'type'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
          'id' => 'ID',
          'type' => 'Обращение',
          'client_id' => 'Клиент',
          'staffer_id' => 'Сотрудник',
          'time' => 'Время',
          'status' => 'Статус клиента',
          'matter' => 'Предмет',
          'category_id' => 'Категория',
          'result' => 'Результат',
          'comment' => 'Комментарий',
          'created_at' => 'Дата создания',
          'updated_at' => 'Дата редактирования',
        ];
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getCategory()
    {
        return $this->hasOne(CallCategory::className(), ['id' => 'category_id']);
    }
    
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
    
    public function getStaffer()
    {
        $stafferModel = yii::$app->getModule('client')->stafferModel;
        
        return $this->hasOne($stafferModel, ['id' => 'staffer_id']);
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        if($this->status) {
            $this->client->setStatus($this->status);
        }
        
        parent::afterSave($insert, $changedAttributes);
    }
    
    public function beforeValidate()
    {
        if(empty($this->staffer_id)) {
            $this->staffer_id = yii::$app->user->id;
        }
        
        if($this->isNewRecord && empty($this->time)) {
            $this->time = date('Y-m-d H:i:s');
        }
        
        return parent::beforeValidate();
    }
}
