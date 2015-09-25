<?php
/**
 * TravisDeployer
 *
 * @link      https://github.com/Enrise/TravisDeployer for the canonical source repository
 * @copyright Copyright (c) 2015 Enrise BV
 * @license   https://github.com/Enrise/TravisDeployer/blob/master/LICENSE GNU v3 License
 */
namespace Enrise\TravisDeployer;

use Symfony\Component\Yaml\Parser;

class TravisDeployer
{
    /**
     * @var array<string branch, string stage>
     */
    protected $branches;

    /**
     * @var bool
     */
    protected $verbose;

    /**
     * Load the config on init
     */
    public function __construct()
    {
        $this->getConfig();
    }

    /**
     * Parse the config and place them into protected variables
     */
    private function getConfig()
    {
        $yaml = new Parser();

        $configFile = getenv('TRAVIS_BUILD_DIR') . '/.travis.yml';

        $config = $yaml->parse(file_get_contents($configFile));
        $config = $config['travisdeployer'];

        $this->branches = $config['branches'];
        if (count($this->branches) === 0) {
            die('No branches are configured to deploy to.' . PHP_EOL);
        }

        $this->verbose = filter_input(FILTER_VALIDATE_BOOLEAN, $config['verbose']);
    }

    /**
     * Deploy to the configured branch
     */
    public function deploy()
    {
        $pullRequest = getenv('TRAVIS_PULL_REQUEST');
        $branch = getenv('TRAVIS_BRANCH');

        if ((int) $pullRequest >= 1) {
            die('Not deploying pull requests.' . PHP_EOL);
        }

        if (!array_key_exists($branch, $this->branches)) {
            die('Branch ' . $branch . ' has no environment to deploy to.' . PHP_EOL);
        }

        $environment = $this->branches[$branch];

        echo 'Downloading Deployer.phar...' . PHP_EOL;
        passthru('wget http://deployer.org/deployer.phar');

        echo 'Deploying...' . PHP_EOL;
        $deployCommand = 'php deployer.phar deploy';
        $deployCommand .= ' ' . $environment;
        $deployCommand .= $this->verbose ? ' -vvv' : '';
        passthru($deployCommand);
    }
}
