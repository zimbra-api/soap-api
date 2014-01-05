<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\DocumentGrantType;
use Zimbra\Soap\Enum\DocumentPermission;
use Zimbra\Utils\SimpleXML;

/**
 * DocumentActionGrant struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocumentActionGrant
{
    /**
     * Permissions - (r)ead, (w)rite, (d)elete
     * @var DocumentPermission
     */
    private $_perm;

    /**
     * Grant type - all|pub
     * @var DocumentGrantType
     */
    private $_gt;

    /**
     * Time when this grant expires in milliseconds since the Epoch
     * @var int
     */
    private $_expiry;

    /**
     * Constructor method for DocumentActionGrant
     * @param DocumentPermission $perm
     * @param DocumentGrantType $gt
     * @param int $expiry
     * @return self
     */
    public function __construct(
        DocumentPermission $perm,
        DocumentGrantType $gt,
        $expiry = null
    )
    {
        $this->_perm = $perm;
        $this->_gt = $gt;
        if(null !== $expiry)
        {
            $this->_expiry = (int) $expiry;
        }
    }

    /**
     * Gets or sets perm
     *
     * @param  DocumentPermission $perm
     * @return DocumentPermission|self
     */
    public function perm(DocumentPermission $perm = null)
    {
        if(null === $perm)
        {
            return $this->_perm;
        }
        $this->_perm = $perm;
        return $this;
    }

    /**
     * Gets or sets gt
     *
     * @param  DocumentGrantType $gt
     * @return DocumentGrantType|self
     */
    public function gt(DocumentGrantType $gt = null)
    {
        if(null === $gt)
        {
            return $this->_gt;
        }
        $this->_gt = $gt;
        return $this;
    }

    /**
     * Gets or sets expiry
     *
     * @param  int $expiry
     * @return int|self
     */
    public function expiry($expiry = null)
    {
        if(null === $expiry)
        {
            return $this->_expiry;
        }
        $this->_expiry = (int) $expiry;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'grant')
    {
        $name = !empty($name) ? $name : 'grant';
        $arr = array(
            'perm' => (string) $this->_perm,
            'gt' => (string) $this->_gt,
        );
        if(is_int($this->_expiry))
        {
            $arr['expiry'] = $this->_expiry;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'grant')
    {
        $name = !empty($name) ? $name : 'grant';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('perm', (string) $this->_perm)
            ->addAttribute('gt', (string) $this->_gt);
        if(is_int($this->_expiry))
        {
            $xml->addAttribute('expiry', $this->_expiry);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
