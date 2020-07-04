SHELL:= /bin/bash

tests:
	symfony console d:f:l -n
	symfony run bin/phpunit
.PHONY: tests