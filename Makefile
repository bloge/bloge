# Bloge Makefile
# 
# This make file simplifies running unit testing commands. That's it.
# Only for PHPUnit testing.

TEST_FOLDERS=tests/resources/{build,non_writable}
NON_WRITABLE=tests/resources/non_writable

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

# Build environment manipulations
clean:
	rm -rf $(TEST_FOLDERS)

create:
	mkdir $(TEST_FOLDERS)
	chmod -R 555 $(NON_WRITABLE)