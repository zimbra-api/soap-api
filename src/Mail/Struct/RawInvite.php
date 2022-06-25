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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * RawInvite struct class
 * The raw invitation
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RawInvite
{
    /**
     * UID
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uid;

    /**
     * Summary
     * @Accessor(getter="getSummary", setter="setSummary")
     * @SerializedName("summary")
     * @Type("string")
     * @XmlAttribute
     */
    private $summary;

    /**
     * Raw iCalendar data
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $content;

    /**
     * Constructor method for RawInvite
     * 
     * @param string $uid
     * @param string $summary
     * @param string $content
     * @return self
     */
    public function __construct(
        ?string $uid = NULL, ?string $summary = NULL, ?string $content = NULL
    )
    {
        if (NULL !== $uid) {
            $this->setUid($uid);
        }
        if (NULL !== $summary) {
            $this->setSummary($summary);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Gets uid
     *
     * @return string
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Sets uid
     *
     * @param  string $uid
     * @return self
     */
    public function setUid(string $uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * Gets summary
     *
     * @return string
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Sets summary
     *
     * @param  string $summary
     * @return self
     */
    public function setSummary(string $summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }
}
