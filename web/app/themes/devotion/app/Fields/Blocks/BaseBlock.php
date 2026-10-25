<?php

namespace App\Fields\Blocks;

// Base Block Class
abstract class BaseBlock
{
    protected $name;
    protected $category;
    protected $fields;

    public function __construct()
    {
        $this->registerBlock();
    }

    abstract public function defineFields();

    private function registerBlock()
    {
        $this->defineFields();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategory()
    {
        return $this->category;
    }

    protected function addConditionalToFields($block, $fieldKey, $operator, $value)
    {
        $fields = $block->getFields();

        foreach ($fields as $field) {

            if ($field->getName() == $fieldKey) {
                continue;
            }

            $config = $field->getConfig();
            if (isset($config['conditional_logic'])) {
                continue;
            }

            $field->conditional($fieldKey, $operator, $value);
        }
    }

    // Activation/Deactivation logic
    // ...
}
