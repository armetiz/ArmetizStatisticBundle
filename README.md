ArmetizStatisticBundle
=====================
[![project status](http://stillmaintained.com/armetiz/ArmetizStatisticBundle.png)](http://stillmaintained.com/armetiz/ArmetizStatisticBundle)
[![Build Status](https://secure.travis-ci.org/armetiz/ArmetizStatisticBundle.png)](http://travis-ci.org/armetiz/ArmetizStatisticBundle)

Give some statistic features to a Symfony Application.

## Installation

Installation is a quick 3 step process:

1. Download ArmetizStatisticBundle using composer
2. Enable the Bundle
3. Configure your application's config.yml

### Step 1: Download ArmetizStatisticBundle using composer

Add ArmetizMediaBundle in your composer.json:

```js
{
    "require": {
        "armetiz/statistic-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update armetiz/statistic-bundle
```

Composer will install the bundle to your project's `vendor/armetiz` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Armetiz\StatisticBundle\ArmetizStatisticBundle(),
    );
}
```
### Step 3: Configure your application's config.yml

Finally, add the following to your config.yml

``` yaml
# app/config/config.yml
armetiz_statistic:
    categories:
        video: ~
        user: ACME\Entity\User
    actions:
        view: true
        share: true
        like: true
    supports:
        iphone: true
        desktop: true
        
```

## Usage
``` php
<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    public function indexAction() {
        /* ... */

        $tracker = $this->get("armetiz.statistic.manager.tracker");
        $tracker->track("user", "view", $user->getId());
    }

}
?>       
```

### Features
- Store an event with this properties : category, action, created date, value, ip, username & support
- An event is dispatch when a new event is stored : Armetiz\StatisticBundle\Event\TrackEvent::TRACK
