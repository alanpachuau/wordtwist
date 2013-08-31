<?php

class BaseController extends Controller {

	protected $layout = 'layouts.blank';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			if(Auth::check() && Auth::user()->type == 'admin')
				$this->layout = 'layouts.admin';
			elseif(Auth::check() && Auth::user()->type == 'player')
				$this->layout = 'layouts.player';

			$this->layout = View::make($this->layout);
		}
	}

}