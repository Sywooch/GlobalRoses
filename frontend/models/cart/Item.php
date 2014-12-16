<?php

namespace frontend\models\cart;

use common\models\items\Available;
use Yii;
use yii\db\ActiveRecord;
use yz\shoppingcart\CartPositionProviderInterface;

/**
 *
 * @inheritdoc
 */
class Item extends ActiveRecord implements CartPositionProviderInterface
{
    public $id;
    public $quantity;

    /**
     * @var Available
     */
    protected $_item;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'id'], 'required'],
            [['id'], 'integer'],
            [['quantity'], 'integer', 'min' => 1]
        ];
    }

    //---------------------------------------------------
    //CartPositionProviderInterface - methods - START
    //---------------------------------------------------

    /**
     * @inheritdoc
     */
    public function getCartPosition($params = [])
    {
        return \Yii::createObject([
            'class' => \frontend\models\cart\ItemPosition::className(),
            'id' => $this->id,
        ]);
    }

    //---------------------------------------------------
    //CartPositionProviderInterface - methods - END
    //---------------------------------------------------
}
