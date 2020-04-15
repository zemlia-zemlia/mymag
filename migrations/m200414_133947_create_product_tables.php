<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200414_133947_create_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()

    {
        $this->execute(
            file_get_contents(
                __DIR__ . '/create_product_tables.sql')
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
