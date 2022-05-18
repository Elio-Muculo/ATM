<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita4a94b2dc6530cd2afdc20bd226aa0fd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInita4a94b2dc6530cd2afdc20bd226aa0fd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita4a94b2dc6530cd2afdc20bd226aa0fd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInita4a94b2dc6530cd2afdc20bd226aa0fd::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}