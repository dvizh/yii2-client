<?php
namespace dvizh\client\models\call;

use dvizh\client\models\CallCategory;
use yii\db\ActiveQuery;

class CallQuery extends ActiveQuery
{
    public function category($childCategoriesIds)
    {
         return $this->andwhere(['category_id' => $childCategoriesIds]);
    }
}