<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $level;
    public $message;

   /**
    * Create a new component instance.
    *
    * @param  string  $level
    * @param  mixed   $message
    */
    public function __construct(string $level, $message)
    {
        $this->level   = $level;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
