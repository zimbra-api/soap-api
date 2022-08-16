# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 2.0.2 - 2022-08-16
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.2...2.0.3)

* PHP 8 attributes supported for (de-)serializing XML

## 2.0.2 - 2022-08-10
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.1...2.0.2)

* Add BatchRequestInterface::getOnError method
* Remove BatchRequestInterface::addRequest method
* Remove BatchResponseInterface::addResponse method
* Remove add to XML list method of all Response Message classes

## 2.0.1 - 2022-08-09
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.0...2.0.1)

* Add ClientInterface::getHttpClient method
* Add SoapEnvelopeInterface::setHeader method
* Add SoapEnvelopeInterface::setBody method

### Refactoring
* refactor: Update PHPdoc of all Struct & Message classes
* refactor: Replace call ENUM static method to new instance in ENUM required properties
* refactor: Replace typed properties with default property declaration of all Struct & Message classes

## 2.0.0 - 2022-08-05
- 2.0.0 release
