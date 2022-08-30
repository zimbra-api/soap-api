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
use JMS\Serializer\Metadata\Driver\{AnnotationDriver, TypedPropertiesDriver};
use JMS\Serializer\Naming\{
    CamelCaseNamingStrategy, PropertyNamingStrategyInterface, SerializedNameAnnotationStrategy
};
use JMS\Serializer\Type\{Parser, ParserInterface};

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
     * Property naming strategy
     * 
     * @var PropertyNamingStrategyInterface
     */
    private PropertyNamingStrategyInterface $propertyNamingStrategy;

    /**
     * Type parser
     * 
     * @var ParserInterface
     */
    private ParserInterface $typeParser;

    /**
     * Constructor
     * 
     * @param PropertyNamingStrategyInterface $propertyNamingStrategy
     * @param ParserInterface $typeParser
     */
    public function __construct(
        ?PropertyNamingStrategyInterface $propertyNamingStrategy = NULL,
        ?ParserInterface $typeParser = NULL
    )
    {
        $this->propertyNamingStrategy = $propertyNamingStrategy ?: new SerializedNameAnnotationStrategy(
            new CamelCaseNamingStrategy()
        );
        $this->typeParser = $typeParser ?: new Parser();
    }

    /**
     * {@inheritdoc}
     */
    public function createDriver(array $metadataDirs, Reader $annotationReader): DriverInterface
    {
        $driver = new AnnotationDriver(
            new AttributeReader(), $this->propertyNamingStrategy, $this->typeParser
        );

        return new TypedPropertiesDriver($driver, $this->typeParser);
    }
}
