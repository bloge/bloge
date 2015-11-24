update:
	composer update

test: clean
	php vendor/bin/phpunit tests --bootstrap bootstrap.php --colors always
	
cover: clean
	php vendor/bin/phpunit tests --bootstrap bootstrap.php --coverage-text --colors always

clean:
	rm -rf tests/resources/build
	mkdir tests/resources/build