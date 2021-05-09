<?php
// See if there are *any* messages queued at all
if ($this->flash->hasMessages()) {
	// If you need to check for errors (eg: when validating a form) you can:
	if ($this->flash->hasErrors()) {
		// There ARE errors
		// Wherever you want to display the messages simply call:
		$this->flash->display();
	} else {
		// Wherever you want to display the messages simply call:
		$this->flash->display();
	}
}
