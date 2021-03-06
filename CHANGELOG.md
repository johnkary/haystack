# Change Log
All notable changes to this project will be documented in this file.
This change log follows ideas put forth in [Keep a CHANGELOG](http://keepachangelog.com/).
This project adheres to [Semantic Versioning](http://semver.org/).

## Unreleased - 2016-05-19

### Changed
* BC Break: ::locate($value) now throws an ElementNotFoundException when looking for something that does not exist
* BC Break: HString classes now use a protected property of `$hString` if they're an `HString` and `$str` if they're a `String` since `string` is a reserved word in PHP7
* BC Break: HString ::toHArray() now assumes an empty-string delimiter. ::toHArray() is now *mostly* an alias to `explode`. This means that the default string-array will be made of characters, not words.
  * This affects HString::toArray() in that it will now create an array of characters rather than words
* Potential BC Break: HArray can now contain objects. So `new HArray(new \DateTime())` is now possible!
* Clean up HString methods
* Whitespace rules added for md, yml, and json files
* **Manual**
    * Some examples were changed to show an alternative manner of declaring the Haystack object for use in pipelining (thanks for the heads-up, @ajmichels!)
    * Made `toArray` work for both HArray and HString

### Fixed
* HArray::remove() no longer makes the entire array have numeric keys if the removed key was numeric
* HArray::toArray() was sometimes returning an \ArrayObject. Now it just returns an array

## [1.0.2](https://github.com/ericpoe/haystack/tree/v1.0.2) - 2016-03-01

### Fixed
* Bugfix: internal storage when generating an HArray from an HString
* Bugfix: Extended HArray and HString classes can also be pipelined

## [1.0.1](https://github.com/ericpoe/haystack/tree/v1.0.1) - 2016-02-16

### Changed
* Minor performance boost to HString::contains

## [1.0.0](https://github.com/ericpoe/haystack/tree/v1.0.0) - 2016-02-15
Rebranding as Haystack.

### Changed
* OArray is now known as HArray
* OString is now known as HString
* Manual is now linked from the main README document

### Fixed
* Now deals with static function declaration

## [0.3.0](https://github.com/ericpoe/haystack/tree/v0.3.0) - 2016-02-09

* Drop support for PHP 5.4 and PHP 5.5
* Reduce duplication in code
* Add tests for bug fixes

## [0.2.0](https://github.com/ericpoe/haystack/tree/v0.2.0) - 2015-07-29
OArray <--> String conversion

* **Manual**
    * Move Pipelining section to be closer to the top since it's a good example of what can be done
    * Add OArray- & OString- specific sections

### Changed

* OArray now has toOString() method. This is an alias to `implode`
* OString now has toOArray() method. This is mostly an alias to `explode`

## [0.1.1](https://github.com/ericpoe/haystack/tree/v0.1.1) - 2015-07-27
Documentation updates

### Changed

* Spacing requirements are now the same for all files
    * 4-space tabs
    * No empty space at the end of a line

* **Manual**
    * Now includes the required use-statements before each example for using this library
    * Remove installation instructions since these are repeated in the README
    * Add example of Collection Pipeline

* **README**
    * Add copy/paste one liner to require the library

## [0.1.0](https://github.com/ericpoe/haystack/tree/v0.1.0) - 2015-07-26
Initial release

### Contains
**Container methods:**

* append
* contains
* insert
* remove
* slice

**Functional methods:**

* filter
* head
* map
* reduce
* tail
* walk

**Math methods:**

* product
* sum
