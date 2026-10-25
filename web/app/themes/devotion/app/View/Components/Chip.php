<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Chip extends Component
{

    public $color;
    public $size;
    public $className;
    public $tag;
    public $link;

    public function __construct($color = 'default', $size = 'sm', $className = '', $tag = 'div', $link = '')
    {
        $this->className = $this->setClassName($color, $size, $className);

        $this->tag = $tag;
        $this->link = $link;

        if ($link) {
            $this->tag = 'a';
        }
    }

    public function render()
    {
        return view('components.chip');
    }

    private function setClassName($color, $size, $className)
    {

        $class = '';

        switch ($color) {
            case 'success':
                $class = 'text-green-800 bg-green-100 hover:bg-green-200';
                break;
            case 'warning':
                $class = 'text-yellow-800 bg-yellow-100 hover:bg-yellow-200';
                break;
            case 'danger':
                $class = 'text-red-800 bg-red-100 hover:bg-red-200';
                break;
            default:
                $class = 'text-gray-800 bg-gray-100 hover:bg-gray-200';
                break;
        }

        switch ($size) {
            case 'md':
                $class .= ' px-3 py-1 leading-5 text-sm ';
                break;
            case 'lg':
                $class .= ' px-4 py-2 leading-5 text-base ';
                break;
            default:
                $class .= ' px-3 py-1 leading-5 text-xs ';
                break;
        }

        return "{$class} {$className}";
    }
}
