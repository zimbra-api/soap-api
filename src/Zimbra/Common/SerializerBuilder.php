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
use JMS\Serializer\Handler\HandlerRegistry;
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
    private static $serializer;

    public static function getSerializer(): SerializerInterface
    {
        if (NULL === static::$serializer) {
            AnnotationRegistry::registerLoader('class_exists');

            static::$serializer = Builder::create()
                ->addDefaultSerializationVisitors()
                ->addDefaultDeserializationVisitors()
                ->setSerializationVisitor('json', new JsonSerializationVisitorFactory)
                ->setDeserializationVisitor('json', new JsonDeserializationVisitorFactory)
                ->setSerializationVisitor('xml', new XmlSerializationVisitorFactory)
                ->setDeserializationVisitor('xml', new XmlDeserializationVisitorFactory)
                ->configureHandlers(function (HandlerRegistry $registry) {
                    $registry->registerSubscribingHandler(new SerializerHandler);
                })
                ->build();
        }
        return static::$serializer;
    }
}
