<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function index()
	{
        $currentPage = "dashboard/dashboard";
        $this->setMenu('dashboard');
	    $this->loadPage($currentPage);
	}
}
