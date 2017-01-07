<?php
namespace pistol88\client\models;

use Yii;
use yii\helpers\Url;

class CallCategory extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return '{{%client_call_category}}';
    }

    public function rules()
    {
        return [
            [['parent_id', 'sort'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 55],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Имя категории',
            'sort' => 'Число сортировки',
        ];
    }
	
	public static function buldTree($parent_id = null)
    {
        $return = [];
        
        if(empty($parent_id)) {
            $categories = CallCategory::find()->where('parent_id = 0 OR parent_id is null')->orderBy('id ASC')->asArray()->all();
        } else {
            $categories = CallCategory::find()->where(['parent_id' => $parent_id])->orderBy('id ASC')->asArray()->all();
        }
        
        foreach($categories as $level1) {
            $return[$level1['id']] = $level1;
            $return[$level1['id']]['childs'] = self::buldTree($level1['id']);
        }
        
        return $return;
    }
    
	public static function buildTextTree($id = null, $level = 1, $ban = [])
    {
        $return = [];
        
        $prefix = str_repeat('--', $level);
        $level++;
        
        if(empty($id)) {
            $categories = CallCategory::find()->where('parent_id = 0 OR parent_id is null')->orderBy('id ASC')->asArray()->all();
        } else {
            $categories = CallCategory::find()->where(['parent_id' => $id])->orderBy('id ASC')->asArray()->all();
        }
        
        foreach($categories as $category) {
            if(!in_array($category['id'], $ban)) {
                $return[$category['id']] = "$prefix {$category['name']}";
                $return = $return + self::buildTextTree($category['id'], $level, $ban);
            }
        }
        
        return $return;
    }
    
	public function getParent()
    {
		return $this->hasOne(CallCategory::className(), ['id' => 'parent_id']);
	}
}
