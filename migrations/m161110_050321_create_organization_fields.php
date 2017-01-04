<?php

use yii\db\Migration;

class m161110_050321_create_organization_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%client_client}}', 'organization_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%client_client}}', 'organization_id');
        
        return true;
    }
}
