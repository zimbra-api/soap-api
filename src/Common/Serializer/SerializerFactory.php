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

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\{SerializerBuilder, SerializerInterface};
use Zimbra\Common\Serializer\{
    XmlDeserializationVisitorFactory,
    XmlSerializationVisitorFactory
};

/**
 * SerializerFactory class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Serializer
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
final class SerializerFactory
{
    private static $builder;

    private static $serializerHandlers = [];

    public static function addSerializerHandler(SubscribingHandlerInterface $handler)
    {
        self::$serializerHandlers[] = $handler;
    }

    public static function create(): SerializerInterface
    {
        if (NULL === self::$builder) {
            AnnotationRegistry::registerLoader('class_exists');

            self::$builder = SerializerBuilder::create()
                ->addDefaultHandlers()
                ->setSerializationVisitor('xml', new XmlSerializationVisitorFactory())
                ->setDeserializationVisitor('xml', new XmlDeserializationVisitorFactory());
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
