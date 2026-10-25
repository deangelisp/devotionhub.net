<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Alert extends Component
{
    public $type;
    public $title;
    public $buttons;
    public $className;

    /**
     * The alert types.
     *
     * @var array
     */
    public $types = [
        'info' => 'text-blue-800 border-blue-300  bg-blue-50',
        'success' => 'text-green-800 border-green-300  bg-green-50',
        'danger' => 'text-red-800 border-red-300  bg-red-50',
        'warning' => 'text-yellow-800 border-yellow-300  bg-yellow-50',
    ];

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type = 'info', $title = null, $buttons = null)
    {
        $this->className = $this->types[$type] ?? $this->types['info'];
        $this->type = $type;
        $this->title = $title;
        $this->buttons = $buttons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.alert');
    }
}
