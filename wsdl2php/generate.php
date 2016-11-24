<?php
/**
 * @package Wsdl2PhpGenerator
 */

/**
 * Gettext should not be required - Thanks jeichhor
 */
if (!function_exists("_")) {
    function _($str)
    {
        return gettext($str);
    }
}

if (!function_exists("gettext")) {
    function gettext($str)
    {
        return $str;
    }
}

/**
 * Include the needed files
 */
require_once dirname(__FILE__) . '/lib/cli/Cli.php';
require_once dirname(__FILE__) . '/lib/config/FileConfig.php';

require_once dirname(__FILE__) . '/src/Generator.php';

// Try to read the config file if any
try {
    $config = new FileConfig(dirname(__FILE__) . '/conf/settings.conf');
    $locale = $config->get('language');

    $domain = 'messages';
    $lcDir = 'LC_MESSAGES';
    $path = 'conf/translations';
    $loc = substr($locale, 0, 5);
    $file = $path . '/' . $loc . '/' . $lcDir . '/' . $domain . '.mo';

    if (file_exists($file) == false) {
        throw new Exception('The selected language file (' . $file . ') does not exist!');
    }

    bindtextdomain($domain, $path);
    textdomain($domain);
    setlocale(LC_ALL, $locale);
} catch (Exception $e) {
    // This should be the no file exception, then use the default settings
}


if ($singleFile && strlen($classNames) > 0) {
    // Print different messages based on if more than one class is requested for generation
    if (strpos($classNames, ',') !== false) {
        print printf(_('You have selected to only generate some of the classes in the wsdl(%s) and to save them in one file. Continue? [Y/n]'), $classNames) . PHP_EOL;
    } else {
        print _('You have selected to only generate one class and save it to a single file. If you have selected the service class and outputs this file to a directory where you previosly have generated the classes the file will be overwritten. Continue? [Y/n]') . PHP_EOL;
    }

    //TODO: Refactor this to cli class?

    // Force the user to supply a valid input
    while (true) {
        $cmd = readline(null); // Reads from the standard input

        if (in_array($cmd, array('', 'y', 'Y', 'yes'))) {
            break; // Continue
        } else if (in_array($cmd, array('n', 'no', 'N'))) {
            exit; // Terminate
        }

        print _('Please select yes or no.') . PHP_EOL;
    }
}

$config = new Config("", "");
$generator = Generator::instance();
$generator->generate($config);

