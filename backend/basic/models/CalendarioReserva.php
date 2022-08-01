<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calendario_reserva".
 *
 * @property int $id
 * @property int $id_calendario
 * @property int|null $id_reserva
 *
 * @property Calendario $calendario
 * @property ReservaAula $reserva
 */
class CalendarioReserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendario_reserva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_calendario'], 'required'],
            [['id_calendario', 'id_reserva'], 'default', 'value' => null],
            [['id_calendario', 'id_reserva'], 'integer'],
            [['id_calendario'], 'exist', 'skipOnError' => true, 'targetClass' => Calendario::className(), 'targetAttribute' => ['id_calendario' => 'id']],
            [['id_reserva'], 'exist', 'skipOnError' => true, 'targetClass' => ReservaAula::className(), 'targetAttribute' => ['id_reserva' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_calendario' => 'Id Calendario',
            'id_reserva' => 'Id Reserva',
        ];
    }

    /**
     * Gets query for [[Calendario]].
     *
     * @return \yii\db\ActiveQuery|CalendarioQuery
     */
    public function getCalendario()
    {
        return $this->hasOne(Calendario::className(), ['id' => 'id_calendario']);
    }

    /**
     * Gets query for [[Reserva]].
     *
     * @return \yii\db\ActiveQuery|ReservaAulaQuery
     */
    public function getReserva()
    {
        return $this->hasOne(ReservaAula::className(), ['id' => 'id_reserva']);
    }

    /**
     * {@inheritdoc}
     * @return CalendarioReservaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CalendarioReservaQuery(get_called_class());
    }
}
