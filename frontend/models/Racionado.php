<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_Racionado".
 *
 * @property string $CodItem
 * @property string $CodUbic
 * @property integer $dias
 * @property integer $activo
 */
class Racionado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ESTATUS_ACTIVE=1;
    const ESTATUS_INACTIVE=0;
    public static function tableName()
    {
        return 'ISAU_Racionado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodItem', 'CodUbic'], 'required'],
            [['CodItem', 'CodUbic'], 'string'],
            [['dias', 'activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodItem' => 'Item',
            'CodUbic' => 'Ubicación',
            'dias' => 'Dias',
            'activo' => 'Activo',
        ];
    }

    public function getActivo(){
        $r = $this->activo;
        if($r == 1){
            $z = "SI";
        }else{
            $z = 'NO';
        }
        return $z;
    }
}
