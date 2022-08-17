<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Serializer;

use JMS\Serializer\{
    Handler\HandlerRegistryInterface,
    Handler\SubscribingHandlerInterface,
    SerializerBuilder,
    SerializerInterface,
};

/**
 * Serializer factory class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Serializer
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
final class SerializerFactory
{
    /**
     * Serializer builder
     *
     * @var SerializerBuilder
     */
    private static ?SerializerBuilder $builder = NULL;

    /**
     * Debug mode
     *
     * @var bool
     */
    private static bool $debug = FALSE;

    /**
     * Cache dir
     * 
     * @var string
     */
    private static ?string $cacheDir = NULL;

    /**
     * List of serializer handlers.
     *
     * @var array
     */
    private static array $serializerHandlers = [];

    /**
     * Set serializer debug mode
     *
     * @param  bool $debug
     * @return bool
     */
    public static function setDebugMode(bool $debug = FALSE): bool
    {
        return self::$debug = $debug;
    }

    /**
     * Set serializer cache dir
     *
     * @param  string $cacheDir
     * @return string
     */
    public static function setCacheDir(?string $cacheDir = NULL): ?string
    {
        return self::$cacheDir = $cacheDir;
    }

    /**
     * Add serializer handler
     *
     * @param  SubscribingHandlerInterface $handler
     * @return array
     */
    public static function addSerializerHandler(SubscribingHandlerInterface $handler): array
    {
        self::$serializerHandlers[] = $handler;
        return self::$serializerHandlers;
    }

    /**
     * Set serializer handlers
     *
     * @param  array $handlers
     * @return array
     */
    public static function setSerializerHandlers(array $handlers = []): array
    {
        self::$serializerHandlers = array_filter(
            $handlers, static fn ($handler) => $handler instanceof SubscribingHandlerInterface
        );
        return self::$serializerHandlers;
    }

    /**
     * Create serializer
     *
     * @return SerializerInterface
     */
    public static function create(): SerializerInterface
    {
        if (!(self::$builder instanceof SerializerBuilder)) {
            self::addSerializerHandler(new EnumSerializerHandler());
            self::$builder = SerializerBuilder::create();
        }

        if (self::$debug) {
            self::$builder->setDebug(self::$debug);
        }
        if (NULL !== self::$cacheDir) {
            self::$builder->setCacheDir(self::$cacheDir);
        }

        return self::$builder->configureHandlers(static function (HandlerRegistryInterface $registry) {
            if (!empty(self::$serializerHandlers)) {
                foreach (self::$serializerHandlers as $key => $handler) {
                    $registry->registerSubscribingHandler($handler);
                    unset(self::$serializerHandlers[$key]);
                }
            }
        })->build();
    }
}
