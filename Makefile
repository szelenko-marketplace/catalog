.PHONY: check
check:
	bin/php-cs-fixer check --diff
	bin/phpstan analyse src

.PHONY: fix
fix:
	bin/php-cs-fixer fix --diff

.PHONY: test
test:
	bin/phpunit
