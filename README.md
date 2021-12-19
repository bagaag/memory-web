# memory-web

This project is the web front-end for the Memory CLI application at [memory-cli](https://github.com/bagaag/memory-cli).

Technologies used:

* PHP 7.4 - no frameworks, just keeping it simple
* Twig - template engine
* Modern web standards for CSS and JavaScript - no frameworks or libraries

Roadmap:

* UX prototype - Completed January 2021
* Cognito integration
* Stubs for web service integration and define REST API
* Implement web service in Go / Mongo
* Complete web service integration

Architecture goals:
* Low/no cost during ramp up & pre-revenue period
* Low cost scaling
* Minimize cloud service depedencies
    * cognito is a big one, but don't want to build this and there isn't a great open source standard
* Host on single tiny instance but scalable to domain-specific instance farms

Architecture:
* Front end: PHP & Twig
* Identity/auth/session state: Cognito (free up to 50k monthly active users)
* Back-end: Go API (designed to be hosted in Lambda if/when needed)
* Database: MongoDB (free tier cloud service)
* Search: MongoDB (Atlas: 512MB/free -> 5GB/$25)
* Storage: Image server using localfs cache backed by S3
    /spaces/[space]/[entry]/file.ext?use-querystring-to-validate-cognito-session

Debugging:
* xdebug requires PHP 8.1
* php_yaml.dll will not load in PHP 8.1 - gave up
