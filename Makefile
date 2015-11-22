update:
	composer update

test: clean
	php vendor/bin/phpunit tests --bootstrap bootstrap.php
	
cover: clean
	php vendor/bin/phpunit tests --bootstrap bootstrap.php --coverage-text

clean:
	rm -rf tests/resources/build
	mkdir tests/resources/build