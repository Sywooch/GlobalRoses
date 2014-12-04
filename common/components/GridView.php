<?php

namespace common\components;

use Yii;
use Closure;
use yii\helpers\Html;

class GridView extends \yii\grid\GridView
{
    public $tableOptions = ['class' => 'well well-sm'];

    /**
     * @inheritdoc
     */
    public function renderItems()
    {
        $caption = $this->renderCaption();
        $tableBody = $this->renderContentBody();
        $content = array_filter([
            $caption,
            $tableBody,
        ]);

        return Html::tag('div', implode("\n", $content), $this->tableOptions);
    }

    /**
     * Renders the table body.
     * @return string the rendering result.
     */
    public function renderContentBody()
    {
        $models = array_values($this->dataProvider->getModels());
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach ($models as $index => $model) {
            $key = $keys[$index];
            if ($this->beforeRow !== null) {
                $row = call_user_func($this->beforeRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }

            $rows[] = $this->renderBodyRow($model, $key, $index);

            if ($this->afterRow !== null) {
                $row = call_user_func($this->afterRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }
        }
        return "<ul class='product-list'>\n" . implode("\n", $rows) . "\n</ul>";
    }

    /**
     * Renders a table row with the given data model and key.
     * @param mixed $model the data model to be rendered
     * @param mixed $key the key associated with the data model
     * @param integer $index the zero-based index of the data model among the model array returned by [[dataProvider]].
     * @return string the rendering result
     */
    public function renderBodyRow($model, $key, $index)
    {
        $cells = [];
        /* @var $column \yii\grid\Column */
        foreach ($this->columns as $column) {
            $cells[] = $column->renderDataCell($model, $key, $index);
        }
        if ($this->rowOptions instanceof Closure) {
            $options = call_user_func($this->rowOptions, $model, $key, $index, $this);
        } else {
            $options = $this->rowOptions;
        }
        $options['data-key'] = is_array($key) ? json_encode($key) : (string)$key;

        return Html::tag('li', '<div class="product-details">' . implode('', $cells) . '</div>', $options);
    }
}