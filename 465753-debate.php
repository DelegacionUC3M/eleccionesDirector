<?php
$headers = getallheaders();
$body = file_get_contents('php://input');
print_r('trying...');
if ('sha1='.hash_hmac('sha1', $body, '456731321safjnaslkcnkls') == $headers['X-Hub-Signature']) {
	print_r('OK');
	print_r(shell_exec('cd /var/www/debate && git pull 2>&1'));
} else {
	header('HTTP/1.0 401 Unauthorized');
}