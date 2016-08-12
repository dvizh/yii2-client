<?php
namespace pistol88\client\models\client;

use pistol88\client\models\Category;
use yii\db\ActiveQuery;

class ClientQuery extends ActiveQuery
{
    public function category($childCategoriesIds)
    {
         return $this->andwhere(['category_id' => $childCategoriesIds]);
    }
}