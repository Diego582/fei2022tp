<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%calendario}}`.
 */
class m220801_041504_create_calendario_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%calendario}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'start' => $this->dateTime()->notNull(),
            'end' => $this->dateTime()->notNull(),
            'color' => $this->string(128)->notNull(),
            'details' => $this->string(128)->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%calendario}}');
    }
}
