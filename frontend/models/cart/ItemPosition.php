<?php

namespace frontend\models\cart;

use common\models\items\Available;
use Yii;
use yii\base\Object;
use yz\shoppingcart\CartPositionInterface;

/**
 *
 * @inheritdoc
 */
class ItemPosition extends Object implements CartPositionInterface
{
    public $id;

    protected $quantity;

    /**
     * @var Available
     */
    protected $_item;

    //---------------------------------------------------
    //CartPositionInterface - methods - START
    //---------------------------------------------------

    public function getPrice()
    {
        return $this->getItem()->unit_price;
    }

    /**
     * ItemPosition::getItem()
     *
     * @author: Andreas Kondylis
     * @version: 0.1
     * @return Available|null
     */
    public function getItem()
    {
        if ($this->_item === null) {
            $this->_item = Available::findOne($this->id);
        }
        return $this->_item;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param bool $withDiscount
     * @return float
     */
    public function getCost($withDiscount = false)
    {
        $cost = bcmul((string)$this->getQuantity(),
            (string)$this->getPrice(), 2);
        return $cost;
    }

    //---------------------------------------------------
    //CartPositionInterface - methods - END
    //---------------------------------------------------
}
