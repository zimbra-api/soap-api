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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * BufferedCommitInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present scheme Nguyen Van Nguyen.
 */
class BufferedCommitInfo
{
    /**
     * Account ID
     * 
     * @Accessor(getter="getAid", setter="setAid")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAid', setter: 'setAid')]
    #[SerializedName('aid')]
    #[Type('string')]
    #[XmlAttribute]
    private $aid;

    /**
     * Commit ID
     * 
     * @Accessor(getter="getCid", setter="setCid")
     * @SerializedName("cid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getCid', setter: 'setCid')]
    #[SerializedName('cid')]
    #[Type('string')]
    #[XmlAttribute]
    private $cid;

    /**
     * Constructor
     *
     * @param string $aid
     * @param string $cid
     * @return self
     */
    public function __construct(string $aid = '', string $cid = '')
    {
        $this->setAid($aid)
             ->setCid($cid);
    }

    /**
     * Get aid
     *
     * @return string
     */
    public function getAid(): string
    {
        return $this->aid;
    }

    /**
     * Set aid
     *
     * @param  string $aid
     * @return self
     */
    public function setAid(string $aid): self
    {
        $this->aid = $aid;
        return $this;
    }

    /**
     * Get cid
     *
     * @return string
     */
    public function getCid(): string
    {
        return $this->cid;
    }

    /**
     * Set cid
     *
     * @param  string $cid
     * @return self
     */
    public function setCid(string $cid): self
    {
        $this->cid = $cid;
        return $this;
    }
}
