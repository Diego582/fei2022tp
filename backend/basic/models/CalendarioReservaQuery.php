<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CalendarioReserva]].
 *
 * @see CalendarioReserva
 */
class CalendarioReservaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CalendarioReserva[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CalendarioReserva|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
