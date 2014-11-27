<?php

namespace common\components;

use Yii;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\helpers\Html;

class DetailView extends \kartik\detail\DetailView
{
    /**
     * @var bool whether the grid view will have Bootstrap table styling.
     */
    public $bootstrap = true;

    /**
     * @var bool whether the grid table will have a `condensed` style.
     * Applicable only if `bootstrap` is `true`. Defaults to `true`.
     */
    public $condensed = true;

    /**
     * @var bool whether the grid table will have a `responsive` style.
     * Applicable only if `bootstrap` is `true`. Defaults to `true`.
     */
    public $responsive = true;

    /**
     * @var bool whether the grid table will highlight row on `hover`.
     * Applicable only if `bootstrap` is `true`. Defaults to `false`.
     */
    public $hover = false;

    /**
     * @var bool whether to enable edit mode for the detail view. Defaults to `false`.
     */
    public $enableEditMode = false;

    /**
     * @var string the buttons to show when in view mode. The following tags will be replaced:
     * - `{previous}`: the previous button
     * - `{update}`: the update button
     * - `{delete}`: the delete button
     * - `{next}`: the next button
     * Defaults to `{previous} {update} {delete} {next}`.
     */
    public $buttons1 = '{previous} {update} {delete} {next}';

    /**
     * @var array the HTML attributes for the previous button. This will redirect to the previous item.
     * The following special options are recognized:
     * - `label`: the previous button label. This will not be HTML encoded.
     *    Defaults to '<span class="glyphicon glyphicon-step-backward"></span>'.
     */
    public $previousOptions = [];

    /**
     * @var array the HTML attributes for the next button. This will redirect to the next item.
     * The following special options are recognized:
     * - `label`: the next button label. This will not be HTML encoded.
     *    Defaults to '<span class="glyphicon glyphicon-step-forward"></span>'.
     */
    public $nextOptions = [];

    /**
     * @var array the HTML attributes for the container displaying the VIEW mode buttons.
     */
    public $viewButtonsContainer = ['class' => 'btn-group', 'role' => 'group'];

    public function init()
    {
        foreach ($this->attributes as $attribute) {
            static::validateAttribute($attribute);
        }
        Html::addCssClass($this->options, 'detail-view');
        $this->validateDisplay();
        if ($this->bootstrap) {
            Html::addCssClass($this->options, 'table');
            if ($this->hover) {
                Html::addCssClass($this->options, 'table-hover');
            }
            if ($this->bordered) {
                Html::addCssClass($this->options, 'table-bordered');
            }
            if ($this->striped) {
                Html::addCssClass($this->options, 'table-striped');
            }
            if ($this->condensed) {
                Html::addCssClass($this->options, 'table-condensed');
            }
        }
        Html::addCssStyle($this->labelColOptions, "text-align:{$this->hAlign};vertical-align:{$this->vAlign};");
        parent:: init();
        if (empty($this->container['id'])) {
            $this->container['id'] = $this->getId();
        }
        $this->initI18N();
        $this->template = strtr($this->template, [
            '<th>' => Html::beginTag('th', $this->labelColOptions),
            '<td>' => Html::beginTag('td', $this->valueColOptions)
        ]);
        Html::addCssClass($this->formOptions, 'kv-detail-view-form');
        $this->formOptions['fieldConfig']['template'] = "{input}\n{hint}\n{error}";
        $this->_form = ActiveForm::begin($this->formOptions);
        $this->registerAssets();
    }

    /**
     * Validates the display of correct attributes and buttons
     * at initialization based on mode
     */
    protected function validateDisplay()
    {
        return null;
    }

    /**
     * Initialization for i18n translations
     */
    public function initI18N()
    {
        Yii::setAlias('@kvdetail', dirname(__FILE__));
        if (empty($this->i18n)) {
            $this->i18n = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvdetail/messages',
                'forceTranslation' => true
            ];
        }
        Yii::$app->i18n->translations['kvdetail'] = $this->i18n;
    }

    /**
     * Renders the detail view.
     * This is the main entry of the whole detail view rendering.
     */
    public function run()
    {
        $output = $this->renderDetailView();
        if (is_array($this->panel) && !empty($this->panel) && $this->panel !== false) {
            $output = $this->renderPanel($output);
        }
        $output = strtr($this->mainTemplate, [
            '{detail}' => Html::tag('div', $output, $this->container)
        ]);
        Html::addCssClass($this->viewButtonsContainer, 'kv-buttons-1');
        echo strtr($output, [
            '{buttons}' => Html::tag('div', $this->renderButtons(1), $this->viewButtonsContainer)
        ]);
        ActiveForm::end();
    }

    /**
     * Renders a single attribute.
     *
     * @param array $attribute the specification of the attribute to be rendered.
     * @param integer $index the zero-based index of the attribute in the [[attributes]] array
     * @return string the rendering result
     */
    protected function renderAttribute($attribute, $index)
    {
        $dispAttr = $this->formatter->format($attribute['value'], $attribute['format']);
        Html::addCssClass($this->viewAttributeContainer, 'kv-attribute');
        $output = Html::tag('div', $dispAttr, $this->viewAttributeContainer) . "\n";

        if (is_string($this->template)) {
            return strtr($this->template, [
                '{label}' => $attribute['label'],
                '{value}' => $output
            ]);
        } else {
            return call_user_func($this->template, $attribute, $index, $this);
        }
    }

    /**
     * Renders the buttons for a specific mode
     *
     * @param integer $mode
     * @return string the buttons content
     */
    protected function renderButtons($mode = 1)
    {
        $buttons = "buttons{$mode}";
        return strtr($this->$buttons, [
            '{previous}' => $this->renderButton('previous'),
            '{update}' => $this->renderButton('update'),
            '{delete}' => $this->renderButton('delete'),
            '{next}' => $this->renderButton('next'),
        ]);
    }

    /**
     * Gets the default button
     *
     * @param string $type the button type
     * @return string
     */
    protected function getDefaultButton($type, $label, $title, $options)
    {
        $btnStyle = empty($this->panel['type']) ? self::TYPE_DEFAULT : $this->panel['type'];
        $isEmpty = empty($options);
        $label = ArrayHelper::remove($options, 'label', $label);
        if (empty($options['class'])) {
            $options['class'] = 'btn btn-xs btn-' . $btnStyle;
        }
        Html::addCssClass($options, 'kv-btn-' . $type);
        $options = ArrayHelper::merge(['title' => Yii::t('kvdetail', $title)], $options);

        $url = ArrayHelper::remove($options, 'url', '#');
        return Html::a($label, $url, $options);
    }

    /**
     * Renders a button
     *
     * @param string $type the button type
     * @return string
     */
    protected function renderButton($type)
    {
        if ($type === 'previous') {
            return $this->getDefaultButton('previous', '<i class="glyphicon glyphicon-step-backward"></i>', 'Previous', $this->previousOptions);
        }
        if ($type === 'update') {
            return $this->getDefaultButton('update', '<i class="glyphicon glyphicon-pencil"></i>', 'Edit', $this->updateOptions);
        }
        if ($type === 'delete') {
            return $this->getDefaultButton('delete', '<i class="glyphicon glyphicon-trash"></i>', 'Delete', $this->deleteOptions);
        }
        if ($type === 'next') {
            return $this->getDefaultButton('next', '<i class="glyphicon glyphicon-step-forward"></i>', 'Next', $this->nextOptions);
        }
    }
}