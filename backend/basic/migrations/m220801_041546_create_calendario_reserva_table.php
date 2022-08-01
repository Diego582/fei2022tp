<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%calendario_reserva}}`.
 */
class m220801_041546_create_calendario_reserva_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%calendario_reserva}}', [
            'id' => $this->primaryKey(),
            'id_calendario' => $this->integer()->notNull(),
            'id_reserva' => $this->integer(),

        ]);
        $this->addForeignKey(
            'fk-calendario_reserva-id_calendario',
            'calendario_reserva',
            'id_calendario',
            'calendario',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-calendario_reserva-id_reserva',
            'calendario_reserva',
            'id_reserva',
            'reserva_aula',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%calendario_reserva}}');
    }
}
