<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%materia}}`.
 */
class m220711_221354_create_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%materia}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(128)->notNull(),
            'cant_alumnos' => $this->integer()->notNull()->defaultValue(5),
            'id_carrera' => $this->integer()->notNull(),
            'id_profesor' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-materia-id_carrera',
            'materia',
            'id_carrera',
            'carrera',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-materia-id_profesor',
            'materia',
            'id_profesor',
            'profesor',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%materia}}');
    }
}
