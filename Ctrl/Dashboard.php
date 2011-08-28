<?php

class Dashboard
{

	public function index() {
		echo "Hello World !";

		CaptureView::showForm();
		$l = new Capture(null,null);
		//$l->load();
	}
}

?>
