<?php

function getHash($hash) {
	global $salt;

	return md5($salt . $hash);
}
