<?php
use Enrise\TravisDeployer\TravisDeployer;

require __DIR__ . '/../vendor/autoload.php';

$deployer = new TravisDeployer();
$deployer->deploy();
