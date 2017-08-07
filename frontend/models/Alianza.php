<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_Alianza".
 *
 * @property integer $id_alianza
 * @property string $CodProv
 * @property string $porcentaje
 * @property integer $activo
 *
 * @property Proveedor $codProv
 * @property ISAUAlianzaTransaccion[] $iSAUAlianzaTransaccions
 */
class Alianza extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_Alianza';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodProv'], 'required'],
            [['CodProv'], 'string'],
            [['porcentaje'], 'number'],
            [['activo'], 'integer'],
            [['CodProv'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['CodProv' => 'CodProv']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_alianza' => 'Id Alianza',
            'CodProv' => 'Cod Prov',
            'porcentaje' => 'Porcentaje',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodProv()
    {
        return $this->hasOne(Proveedor::className(), ['CodProv' => 'CodProv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUAlianzaTransaccions()
    {
        return $this->hasMany(ISAUAlianzaTransaccion::className(), ['id_alianza' => 'id_alianza']);
    }
}
