[![TYPO3 11](https://img.shields.io/badge/TYPO3-11-orange.svg)](https://get.typo3.org/version/11)
[![TYPO3 12](https://img.shields.io/badge/TYPO3-12-orange.svg)](https://get.typo3.org/version/12)
[![TYPO3 13](https://img.shields.io/badge/TYPO3-13-orange.svg)](https://get.typo3.org/version/13)
[![Latest Stable Version](http://poser.pugx.org/dskzpt/personio/v)](https://packagist.org/packages/dskzpt/personio)
[![Total Downloads](http://poser.pugx.org/dskzpt/personio/downloads)](https://packagist.org/packages/dskzpt/personio)
[![Latest Unstable Version](http://poser.pugx.org/dskzpt/personio/v/unstable)](https://packagist.org/packages/dskzpt/personio)
[![License](http://poser.pugx.org/dskzpt/personio/license)](https://packagist.org/packages/dskzpt/personio)
[![PHP Version Require](http://poser.pugx.org/dskzpt/personio/require/php)](https://packagist.org/packages/dskzpt/personio)

TYPO3 Extension "personio"
=================================

## What does it do?
Display job offers via the offical Personio XML Feed.

## Installation
The recommended way to install the extension is by
using [Composer](https://getcomposer.org/). In your Composer based TYPO3 project
root, just run:
<pre>composer require dskzpt/personio</pre>

## Setup

1. Install the extension
2. Include the provided static typoscript
3. Add a "Personio: Job List" to any page of your choice
4. Configure the Plugin via it's flexform

## Route Enhancers
In order to generate a nicer URL you can use the following Route Enhancer.
The UID of the Job offering will then be use for the detail page URL.

```
routeEnhancers:
  Personio:
    limitToPages:
      - XX
    type: Extbase
    extension: Personio
    plugin: Show
    routes:
      -
        routePath: '/{uid}'
        _controller: 'Personio::show'
    defaultController: 'Personio::show'
```
*XX = Uid of your page with a show plugin


## Contributing

Please refer to the [contributing](CONTRIBUTING.md) document included in this
repository.

