# Epeiros

Event Based CQRS Micro-framework.

#### Requirements
 - [Ant](https://ant.apache.org/) for building project
 - php with rdkafka installed
 
#### Suggested Tools
 - brew
  
## Initial Setup
```
ant
```
## List available ant targets
```
ant -projecthelp
Buildfile: ./build.xml

Main targets:

 clean                Cleanup build artifacts
 generate-autoloader  Generate autoloader code
 pdepend              Calculate software metrics using PHP_Depend
 php-server           Starting PHP Webserver
 phpcbf               Fix coding standard violations using PHP_CodeSniffer and print result in text format
 phpcpd               Find duplicate code using PHPCPD
 phpcpd-ci            Find duplicate code using PHPCPD and log result in XML format
 phpcs                Find coding standard violations using PHP_CodeSniffer and print result in text format
 phpcs-ci             Find coding standard violations using PHP_CodeSniffer and log result in XML format
 phpcs-makediff       Fix coding standard violations using PHP_CodeSniffer and print result in text format
 phpdox               Generate API documentation using phpDox
 phploc               Measure project size using PHPLOC
 phploc-ci            Measure project size using PHPLOC and log result in CSV and XML format
 phpmd                Perform project mess detection using PHPMD and print result in text format
 phpmd-ci             Perform project mess detection using PHPMD and log result in XML format
 phpunit              Run unit tests with PHPUnit
 prepare              Prepare for build
 ui-server            Starting UI Webserver
 update-dependencies  Updating Composer Dependencies
Default target: build

```

## Run server
```
ant php-server
```