<?php
/**
 * TravisDeployer
 *
 * @link      https://github.com/Enrise/TravisDeployer for the canonical source repository
 * @copyright Copyright (c) 2015 Enrise BV
 * @license   https://github.com/Enrise/TravisDeployer/blob/master/LICENSE GNU v3 License
 */
use Enrise\TravisDeployer\TravisDeployer;

require __DIR__ . '/vendor/autoload.php';

$deployer = new TravisDeployer();
$deployer->deploy();
