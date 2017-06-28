<?php
namespace dvizh\client\models\client;

use dvizh\client\models\Category;
use yii\db\ActiveQuery;

class ClientQuery extends ActiveQuery
{
    public function category($childCategoriesIds)
    {
         return $this->andwhere(['category_id' => $childCategoriesIds]);
    }
}