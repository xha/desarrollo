<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SAINSTA".
 *
 * @property integer $CodInst
 * @property integer $InsPadre
 * @property integer $Nivel
 * @property integer $TipoIns
 * @property string $Descrip
 * @property string $Descto
 * @property integer $DEsComp
 * @property integer $DEsSeri
 * @property integer $DEsLote
 * @property integer $DEsComi
 * @property integer $DEsCorrel
 * @property integer $DigitosC
 * @property integer $DEsTabla
 */
class Instancia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SAINSTA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['InsPadre', 'Nivel', 'TipoIns', 'DEsComp', 'DEsSeri', 'DEsLote', 'DEsComi', 'DEsCorrel', 'DigitosC', 'DEsTabla'], 'integer'],
            [['Descrip'], 'required'],
            [['Descrip'], 'string'],
            [['Descto'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodInst' => 'Cod Inst',
            'InsPadre' => 'Ins Padre',
            'Nivel' => 'Nivel',
            'TipoIns' => 'Tipo Ins',
            'Descrip' => 'Descrip',
            'Descto' => 'Descto',
            'DEsComp' => 'Des Comp',
            'DEsSeri' => 'Des Seri',
            'DEsLote' => 'Des Lote',
            'DEsComi' => 'Des Comi',
            'DEsCorrel' => 'Des Correl',
            'DigitosC' => 'Digitos C',
            'DEsTabla' => 'Des Tabla',
        ];
    }
}
