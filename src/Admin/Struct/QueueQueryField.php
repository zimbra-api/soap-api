<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * QueueQueryField struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class QueueQueryField
{
    /**
     * Field name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Match specifications
     * 
     * @Accessor(getter="getMatches", setter="setMatches")
     * @Type("array<Zimbra\Admin\Struct\ValueAttrib>")
     * @XmlList(inline=true, entry="match", namespace="urn:zimbraAdmin")
     */
    private $matches = [];

    /**
     * Constructor method for QueueQueryField
     * @param  string $name
     * @param  array $matches
     * @return self
     */
    public function __construct(string $name = '', array $matches = [])
    {
        $this->setName($name)
             ->setMatches($matches);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Add a match
     *
     * @param  ValueAttrib $match
     * @return self
     */
    public function addMatch(ValueAttrib $match): self
    {
        $this->matches[] = $match;
        return $this;
    }

    /**
     * Sets match sequence
     *
     * @param  array $matches
     * @return self
     */
    public function setMatches(array $matches): self
    {
        $this->matches = array_filter($matches, static fn ($match) => $match instanceof ValueAttrib);
        return $this;
    }

    /**
     * Gets match sequence
     *
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }
}
