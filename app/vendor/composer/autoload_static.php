<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9205d9f2ed538c28edfbc78732a9ba14
{
    public static $files = array (
        'b929c341f4875b2fdea04d5d2e7f30d7' => __DIR__ . '/../..' . '/config/globals.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/framework',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9205d9f2ed538c28edfbc78732a9ba14::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9205d9f2ed538c28edfbc78732a9ba14::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9205d9f2ed538c28edfbc78732a9ba14::$classMap;

        }, null, ClassLoader::class);
    }
}
