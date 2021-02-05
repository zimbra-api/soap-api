<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\{SerializerBuilder, SerializerInterface};
use Zimbra\Common\Serializer\{
    JsonDeserializationVisitorFactory, JsonSerializationVisitorFactory, XmlDeserializationVisitorFactory, XmlSerializationVisitorFactory
};

/**
 * SerializerFactory class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
final class SerializerFactory
{
    private static $builder;

    private static $serializerHandlers = [];

    public static function addSerializerHandler(SubscribingHandlerInterface $handler)
    {
        static::$serializerHandlers[] = $handler;
    }

    public static function create(): SerializerInterface
    {
        if (NULL === static::$builder) {
            AnnotationRegistry::registerLoader('class_exists');
            static::addSerializerHandler(new SerializerHandler);

            static::$builder = SerializerBuilder::create()
                ->addDefaultHandlers()
                ->setSerializationVisitor('json', new JsonSerializationVisitorFactory)
                ->setDeserializationVisitor('json', new JsonDeserializationVisitorFactory)
                ->setSerializationVisitor('xml', new XmlSerializationVisitorFactory)
                ->setDeserializationVisitor('xml', new XmlDeserializationVisitorFactory);
        }

        return static::$builder->configureHandlers(function (HandlerRegistryInterface $registry) {
            if (!empty(static::$serializerHandlers)) {
                foreach (static::$serializerHandlers as $key => $handler) {
                    $registry->registerSubscribingHandler($handler);
                    unset(static::$serializerHandlers[$key]);
                }
            }
        })->build();
    }
}