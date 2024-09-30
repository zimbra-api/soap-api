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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};

/**
 * RawInvite struct class
 * The raw invitation
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RawInvite
{
    /**
     * UID
     *
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getUid", setter: "setUid")]
    #[SerializedName("uid")]
    #[Type("string")]
    #[XmlAttribute]
    private $uid;

    /**
     * Summary
     *
     * @Accessor(getter="getSummary", setter="setSummary")
     * @SerializedName("summary")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSummary", setter: "setSummary")]
    #[SerializedName("summary")]
    #[Type("string")]
    #[XmlAttribute]
    private $summary;

    /**
     * Raw iCalendar data
     *
     * @Accessor(getter="getContent", setter="setContent")
     * @Type("string")
     * @XmlValue(cdata=false)
     *
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $content;

    /**
     * Constructor
     *
     * @param string $uid
     * @param string $summary
     * @param string $content
     * @return self
     */
    public function __construct(
        ?string $uid = null,
        ?string $summary = null,
        ?string $content = null
    ) {
        if (null !== $uid) {
            $this->setUid($uid);
        }
        if (null !== $summary) {
            $this->setSummary($summary);
        }
        if (null !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Get uid
     *
     * @return string
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Set uid
     *
     * @param  string $uid
     * @return self
     */
    public function setUid(string $uid): self
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Set summary
     *
     * @param  string $summary
     * @return self
     */
    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}
