<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb718d168401b98c09df3de3ff21bbfa6
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

        spl_autoload_register(array('ComposerAutoloaderInitb718d168401b98c09df3de3ff21bbfa6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb718d168401b98c09df3de3ff21bbfa6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb718d168401b98c09df3de3ff21bbfa6::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
