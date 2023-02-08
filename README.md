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

