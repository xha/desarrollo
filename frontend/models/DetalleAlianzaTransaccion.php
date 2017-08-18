<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_DetalleAlianzaTransaccion".
 *
 * @property integer $id_dat
 * @property integer $id_at
 * @property string $CodProd
 * @property string $cantidad
 * @property string $costo
 * @property string $total
 * @property integer $activo
 *
 * @property ISAUAlianzaTransaccion $idAt
 */
class DetalleAlianzaTransaccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_DetalleAlianzaTransaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_at', 'CodProd'], 'required'],
            [['id_at', 'activo'], 'integer'],
            [['CodProd'], 'string'],
            [['cantidad', 'costo', 'total'], 'number'],
            [['id_at'], 'exist', 'skipOnError' => true, 'targetClass' => AlianzaTransaccion::className(), 'targetAttribute' => ['id_at' => 'id_at']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dat' => 'Id Dat',
            'id_at' => 'Id At',
            'CodProd' => 'Cod Prod',
            'cantidad' => 'Cantidad',
            'costo' => 'Costo',
            'total' => 'Total',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAt()
    {
        return $this->hasOne(AlianzaTransaccion::className(), ['id_at' => 'id_at']);
    }
}
