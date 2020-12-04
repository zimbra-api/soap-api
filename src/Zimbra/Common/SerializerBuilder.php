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
use JMS\Serializer\SerializerBuilder as Builder;
use JMS\Serializer\SerializerInterface;
use Zimbra\Common\Serializer\{JsonDeserializationVisitorFactory, JsonSerializationVisitorFactory, XmlDeserializationVisitorFactory, XmlSerializationVisitorFactory};

/**
 * SerializerBuilder class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
final class SerializerBuilder
{
    private static $builder;

    private static $serializerHandlers = [];

    public static function addSerializerHandler(SubscribingHandlerInterface $handler)
    {
        static::$serializerHandlers[] = $handler;
    }

    public static function getSerializer(): SerializerInterface
    {
        if (NULL === static::$builder) {
            AnnotationRegistry::registerLoader('class_exists');

            static::$builder = Builder::create()
                ->addDefaultHandlers()
                ->setSerializationVisitor('json', new JsonSerializationVisitorFactory)
                ->setDeserializationVisitor('json', new JsonDeserializationVisitorFactory)
                ->setSerializationVisitor('xml', new XmlSerializationVisitorFactory)
                ->setDeserializationVisitor('xml', new XmlDeserializationVisitorFactory)
                ->configureHandlers(function (HandlerRegistryInterface $registry) {
                    $registry->registerSubscribingHandler(new SerializerHandler);
                });
        }

        return static::$builder->configureHandlers(function (HandlerRegistryInterface $registry) {
            if (!empty(static::$serializerHandlers)) {
                foreach (static::$serializerHandlers as $handler) {
                    $registry->registerSubscribingHandler($handler);
                }
            }
        })->build();
    }
}
