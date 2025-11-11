<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class TrialNotice extends Component
{
    /**
     * The trial status data.
     *
     * @var array
     */
    public $trialStatus;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->trialStatus = Auth::check() ? Auth::user()->trial_status : [
            'active' => false,
            'days_remaining' => 0,
            'ended' => true,
            'message' => ''
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.trial-notice');
    }

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender()
    {
        // Only render if user is authenticated and on trial
        return Auth::check() && 
               Auth::user()->isOnTrial() && 
               !Auth::user()->hasRole(['admin', 'premium']);
    }
}
