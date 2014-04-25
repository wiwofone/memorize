# Memorize

[![Build Status](https://travis-ci.org/wiwofone/memorize.svg?branch=master)](https://travis-ci.org/wiwofone/memorize)

*A PHP implementation of the SM-2 algorithm.*

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
SM is a family of algorithms made popular by the SuperMemo software package. The Memorize class implements two parts of the [SM-2 algorithm](http://www.supermemo.com/english/ol/sm2.htm) in PHP: a method to calculate intervals in which an item should be repeated, and what E-factor the item should have after being answered with a certain quality.

## Testing
Run PHPUnit with `$ phpunit` in the root directory.

## Author
* Shahin Zarrabi - shahin@wiwo.se - [@wiwofone](http://twitter.com/wiwofone) - http://www.wiwo.se