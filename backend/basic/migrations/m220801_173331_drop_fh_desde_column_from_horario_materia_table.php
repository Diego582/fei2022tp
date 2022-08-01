<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%horario_materia}}`.
 */
class m220801_173331_drop_fh_desde_column_from_horario_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%horario_materia}}', 'fh_desde');
        $this->dropColumn('{{%horario_materia}}', 'fh_hasta');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%horario_materia}}', 'fh_desde', $this->dateTime());
        $this->addColumn('{{%horario_materia}}', 'fh_hasta', $this->dateTime());
    }
}
