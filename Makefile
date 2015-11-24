# Update 
update:
	composer update

# PHPUnit testing
test: clean create
	php vendor/bin/phpunit tests \
	        --bootstrap bootstrap.php \
	        --colors always

cover: clean create
	php vendor/bin/phpunit tests \
	        --bootstrap bootstrap.php \
	        --coverage-text \
	        --colors always

# Folder manipulation
clean:
	rm -rf tests/resources/{build,non_writable}

create:
	mkdir tests/resources/{build,non_writable}
	chmod -R 555 tests/resources/non_writable