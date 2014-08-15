# Memorize

[![Build Status](https://travis-ci.org/wiwofone/memorize.svg?branch=master)](https://travis-ci.org/wiwofone/memorize)

*A PHP implementation of the SM-2 algorithm.*

## About
This is a library created by me to try out popular tools such as Travis, Packagist and Composer, as well as setting up a library structure and enhancing my understanding of test driven development. While being a test project for me, the library is still completely usable and could be used by any database of questions and answers to implement spaced repetition in an application.

## Features
* Calculate the interval in which to repeat an item after the n:th repetition based on an E-factor.
* Calculate an E-factor for an item based on the old factor (or no factor) and a response quality.

## Installation
Memorize is installed through [Composer](http://getcomposer.org/doc/00-intro.md). Add the following to your `composer.json` file.

```js
{
    "require": {
    	"wiwofone/memorize": "1.*"
	}
}
```

## The algorithm
SM is a family of algorithms made popular by the SuperMemo software package. The Memorize library implements  the complete [SM-2 algorithm](http://www.supermemo.com/english/ol/sm2.htm) in PHP. The `SM2` class handles calculating repetition intervals and E-factors. The `Card` class handles flash cards and how many times they have been virtually repeated. Finally, the `Repeater` class handles actual repetition of a `CardQueue`, deciding which cards to repeat first and if they have been repeated successfully or not.

## Testing
Run PHPUnit with `$ phpunit` in the root directory.

## Author
* Shahin Zarrabi - shahin@wiwo.se - [@wiwofone](http://twitter.com/wiwofone) - http://www.wiwo.se