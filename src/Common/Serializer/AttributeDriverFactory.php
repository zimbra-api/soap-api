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

use Doctrine\Common\Annotations\Reader;
use Metadata\Driver\DriverInterface;
use JMS\Serializer\Builder\DriverFactoryInterface;
use JMS\Serializer\Metadata\Driver\AnnotationDriver;
use JMS\Serializer\Metadata\Driver\AttributeDriver\AttributeReader;
use JMS\Serializer\Metadata\Driver\DefaultValuePropertyDriver;
use JMS\Serializer\Naming\CamelCaseNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Type\Parser;

/**
 * Attribute driver factory class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Serializer
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AttributeDriverFactory implements DriverFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createDriver(array $metadataDirs, Reader $annotationReader): DriverInterface
    {
        $propertyNamingStrategy = new SerializedNameAnnotationStrategy(new CamelCaseNamingStrategy());
        $annotationReader = new AttributeReader($annotationReader);
        $driver = new AnnotationDriver($annotationReader, $propertyNamingStrategy, new Parser());

        return new DefaultValuePropertyDriver($driver);
    }
}