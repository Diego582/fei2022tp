<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calendario".
 *
 * @property int $id
 * @property string $name
 * @property string $start
 * @property string $end
 * @property string $color
 * @property string $details
 *
 * @property CalendarioReserva[] $calendarioReservas
 */
class Calendario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start', 'end', 'color', 'details'], 'required'],
            [['start', 'end'], 'safe'],
            [['name', 'color', 'details'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start' => 'Start',
            'end' => 'End',
            'color' => 'Color',
            'details' => 'Details',
        ];
    }

    /**
     * Gets query for [[CalendarioReservas]].
     *
     * @return \yii\db\ActiveQuery|CalendarioReservaQuery
     */
    public function getCalendarioReservas()
    {
        return $this->hasMany(CalendarioReserva::className(), ['id_calendario' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CalendarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CalendarioQuery(get_called_class());
    }
}
