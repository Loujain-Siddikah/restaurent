<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $title;
    public $formAction;
    public $formId;
    public $formMethod;
    public $methodName;

    public function __construct($id, $title, $formAction, $formId, $formMethod, $methodName)
    {
        $this->id = $id;
        $this->title = $title;
        $this->formAction = $formAction;
        $this->formId = $formId;
        $this->formMethod = $formMethod;
        $this->methodName = $methodName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
