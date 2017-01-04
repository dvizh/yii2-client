<?php
namespace pistol88\client\models\call;

use pistol88\client\models\CallCategory;
use yii\db\ActiveQuery;

class CallQuery extends ActiveQuery
{
    public function category($childCategoriesIds)
    {
         return $this->andwhere(['category_id' => $childCategoriesIds]);
    }
}