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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Struct\CustomMetadataInterface;

/**
 * AdminCustomMetadata struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="meta")
 */
class AdminCustomMetadata extends AdminKeyValuePairs implements CustomMetadataInterface
{
    /**
     * Metadata section key.
     * @Accessor(getter="getSection", setter="setSection")
     * @SerializedName("section")
     * @Type("string")
     * @XmlAttribute
     */
    private $section;

    /**
     * Constructor method for AdminCustomMetadata
     * @param string $section
     * @param array $keyValuePairs
     * @return self
     */
    public function __construct($section = NULL, array $keyValuePairs = [])
    {
    	parent::__construct($keyValuePairs);
        if (NULL !== $section) {
            $this->setSection($section);
        }
    }

    /**
     * Gets metadata section key
     *
     * @return string
     */
    public function getSection(): ?string
    {
        return $this->section;
    }

    /**
     * Sets metadata section key
     *
     * @param  string $section
     * @return self
     */
    public function setSection($section): CustomMetadataInterface
    {
        $this->section = trim($section);
        return $this;
    }
}
