<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%reserva_aula}}`.
 */
class m220801_040050_add_procesado_column_to_reserva_aula_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reserva_aula}}', 'procesado', $this->boolean()->defaultValue(true));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reserva_aula}}', 'procesado');
    }
}
