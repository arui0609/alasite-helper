<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitacb7494de44e22b8dd1a07f36d78ddd1
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Arui\\AlaSite\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Arui\\AlaSite\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitacb7494de44e22b8dd1a07f36d78ddd1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitacb7494de44e22b8dd1a07f36d78ddd1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitacb7494de44e22b8dd1a07f36d78ddd1::$classMap;

        }, null, ClassLoader::class);
    }
}
