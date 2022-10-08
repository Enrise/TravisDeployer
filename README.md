# Archived and unmaintained

This is an old repository that is no longer used or maintained. We advice to no longer use this repository.

## Original README can be found below:

# TravisDeployer

[![Travis-CI](https://api.travis-ci.org/Enrise/TravisDeployer.svg?branch=master)](https://travis-ci.org/Enrise/TravisDeployer)
[![Packagist](https://img.shields.io/packagist/v/enrise/travisdeployer.svg)](https://packagist.org/packages/enrise/travisdeployer)
[![Packagist downloads](https://img.shields.io/packagist/dt/enrise/travisdeployer.svg)](https://packagist.org/packages/enrise/travisdeployer)

Combine [Deployer](http://deployer.org/) with [Travis-CI](https://travis-ci.org/) to automatically deploy
after a branch is merged and the build passes.

### Expectations

First of all, we expect you to have the following ready:

1. A `deploy.php` set up in the project root as described in the [Deployer docs](http://deployer.org/docs).
1. Travis-CI is enabled and you have a `.travis.yml` in the project root.
1. You have [composer](https://getcomposer.org/) to load php dependencies.

### Installing

1. Add TravisDeployer to your project using composer running: `composer require enrise/travisdeployer`
1. Add the following code to your `.travis.yml`:
```yml
travisdeployer:                  # our deployer config
    verbose: false               # verbose output the deployment?
    branches:                    # what branches do you want to deploy?
        develop: develop         # deploys stage develop when merging into develop
        master: production       # deploys stage production when merging into master

after_success:                   # after your build succeeded (tests passed)
    - vendor/bin/travisdeployer  # Trigger the travis deployer
```
You can customise the branches and if you want to deploy verbose or not.

### Deploying

Now every time you push code into your branches and the travis-ci build succeeds, the TravisDeployer deploy
script is triggered. This script will deploy when:

* The build is green
* The build is NOT a PR
* The branch pushed to is in the branches list (provided in the travis config)

If all criteria are matched, deployer will be downloaded to your build, and will deploy your code to your server.
What happens during the deployment is what you configured in your projects root `deploy.php` (the Deployer config).

===

TravisDeployer is brought to you by [Rick van der Staaij](https://github.com/RickvdStaaij) and
[Stefan van Essen](https://github.com/eXistenZNL).
