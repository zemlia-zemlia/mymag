<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contacts}}`.
 */
class m200419_101303_add_tree_columns_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'depth', $this->integer(11)->notNull());
        $this->addColumn('{{%category}}', 'lft', $this->integer(11)->notNull());
        $this->addColumn('{{%category}}', 'rgt', $this->integer(11)->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'depth');
        $this->dropColumn('{{%category}}', 'lft');
        $this->dropColumn('{{%category}}', 'rgt');
    }
}
