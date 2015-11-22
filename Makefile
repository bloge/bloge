install:
	composer update

test:
	php vendor/bin/phpunit tests --bootstrap bootstrap.php
	
cover:
	php vendor/bin/phpunit tests --bootstrap bootstrap.php --coverage-text