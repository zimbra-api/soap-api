# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 3.0.1 - 2023-10-03
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/3.0.0...3.0.1)

* Fix mime part of message with group information

## 3.0.0 - 2023-04-17
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.1.0...3.0.0)

* Remove Doctrine annotation
* Remove Attribute reader class
* Remove Enum serializer handler class
* Replace MyClabs Enum by PHP 8.1 BackedEnum
* Replace Http Discovery by PSR Discovery

## 2.1.0 - 2023-04-10
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.8...2.1.0)

* Add resetAccountPassword to admin api
* Add fileSharedWithMe to mail api
* Add getAppointmentIdsInRange to mail api
* Add getAppointmentIdsSince to mail api
* Add isSpellCheckAvailable element to GetInfoResponse
* Add attrs element to ResetPasswordResponse
* Add query element to searchGal account api
* Add twoFactorAuthRequired element to AuthResponse admin api
* Add current, storeType, storeManagerClass attributes to VolumeInfo
* Add VolumeExternalInfo, VolumeExternalOpenIOInfo elements to VolumeInfo
* Add effectiveQuota attribute to GetAccountRequest admin api
* Add storeManagerRuntimeSwitchResult element to SetCurrentVolumeResponse admin api
* Add dryRun attribute to SetPasswordRequest admin api
* Add documentAction to mail api
* Add getDocumentShareURL to mail api
* Change getModifiedItemsIDs mail api
* Add action,type attributes to DocumentSpec

## 2.0.8 - 2022-11-24
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.7...2.0.8)

* Add searchConv method (search a conversation) to MailApi
* Add ignoreSameSite param to auth method of AccountApi

## 2.0.7 - 2022-08-30
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.6...2.0.7)

* Refactor Serializer classes
* Refactor Envolope & Body: Supports typed properties

## 2.0.6 - 2022-08-23
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.5...2.0.6)

* Add object constructor class for deserialization with class have constructor with all optional parameters

## 2.0.5 - 2022-08-18
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.4...2.0.5)

* Refactor SerializedName & Type attributes

## 2.0.4 - 2022-08-17
[Full Changelog](https://github.com/zimbra-api/soap-api/compare/2.0.3...2.0.4)

* Use attribute reader instead of annotation reader for (de-)serializing XML when using PHP 8

## 2.0.3 - 2022-08-16
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
