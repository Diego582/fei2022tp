<?php

namespace app\modules\apiv1\models;

class ReservaAula extends \app\models\ReservaAula
{
    public function fields()
    {
        return ['id', 'id_aula' => 'aula', 'fh_desde', 'fh_hasta', 'observacion', 'procesado'];
    }
}
