<?php

use yii\db\Migration;

class m161110_050321_create_organisation_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%client_client}}', 'organisation_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%client_client}}', 'organisation_id');
        
        return true;
    }
}
