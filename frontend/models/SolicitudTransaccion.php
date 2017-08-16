<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_SolicitudTransaccion".
 *
 * @property integer $id_solicitud
 * @property integer $id_transaccion
 * @property string $CodProd
 * @property integer $cantidad
 * @property integer $activo
 *
 * @property ISAUTransaccion $idTransaccion
 */
class SolicitudTransaccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_SolicitudTransaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccion', 'CodProd'], 'required'],
            [['id_transaccion', 'cantidad', 'activo'], 'integer'],
            [['CodProd'], 'string'],
            [['id_transaccion'], 'exist', 'skipOnError' => true, 'targetClass' => ISAUTransaccion::className(), 'targetAttribute' => ['id_transaccion' => 'id_transaccion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_solicitud' => 'Id Solicitud',
            'id_transaccion' => 'Id Transaccion',
            'CodProd' => 'Cod Prod',
            'cantidad' => 'Cantidad',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransaccion()
    {
        return $this->hasOne(Transaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }
}
