<?php

if (!$users->isLoggedIn())
	$page->show403();

print "meepers";
