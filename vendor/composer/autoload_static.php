<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4f2466de87a5cbd36e0e19bd71ec636d
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SlackApprove\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SlackApprove\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4f2466de87a5cbd36e0e19bd71ec636d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4f2466de87a5cbd36e0e19bd71ec636d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
