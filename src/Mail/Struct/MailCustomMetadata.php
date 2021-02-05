<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Struct\CustomMetadataInterface;

/**
 * MailCustomMetadata struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="meta")
 */
class MailCustomMetadata extends MailKeyValuePairs implements CustomMetadataInterface
{
    /**
     * Section
     * Normally present.  If absent this indicates that CustomMetadata info is present but there are no sections to
     * report on.
     * @Accessor(getter="getSection", setter="setSection")
     * @SerializedName("section")
     * @Type("string")
     * @XmlAttribute
     */
    private $section;

    /**
     * Constructor method for MailCustomMetadata
     *
     * @param string $section
     * @param array $keyValuePairs
     * @return self
     */
    public function __construct(?string $section = NULL, array $keyValuePairs = [])
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
    public function setSection(string $section): self
    {
        $this->section = $section;
        return $this;
    }
}