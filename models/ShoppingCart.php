<?php

namespace app\models;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * ShoppingCart is the model behind the product
 */

class ShoppingCart extends ActiveRecord
{

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */    
    public static function collectionName() 
    {
        return 'shoppingcart';
    }

    public function attributes()
    {
        return ['_id', 'mercadolibre_id', 'name', 'picture', 'status'];

    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['mercadolibre_id', 'name', 'picture', 'status'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'mercadolibre_id' => 'Mercado Libre Id',
            'name' => 'Name',
            'picture' => 'Picture',
            'status' => 'Status',
        ];
    }

}
