**Route Enhancers**
```
routeEnhancers:
  Personio:
    limitToPages:
      - 26
    type: Extbase
    extension: Personio
    plugin: Show
    routes:
      -
        routePath: '/{uid}'
        _controller: 'Personio::show'
    defaultController: 'Personio::show'
```
*26=Uid of your page with a show plugin
