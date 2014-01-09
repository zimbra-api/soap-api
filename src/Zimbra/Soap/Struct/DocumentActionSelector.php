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

use Zimbra\Soap\Enum\DocumentActionOp;

/**
 * DocumentActionSelector struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocumentActionSelector extends ActionSelector
{
    /**
     * Used for "grant" operation
     * @var DocumentActionGrant
     */
    private $_grant;

    /**
     * Zimbra ID of the grant to revoke (Used for "!grant" operation)
     * @var string
     */
    private $_zid;

    /**
     * Constructor method for AccountACEInfo
     * @param DocumentActionOp $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $l
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $f
     * @param string $t
     * @param string $tn
     * @param DocumentActionGrant $grant
     * @param string $zid
     * @return self
     */
    public function __construct(
        DocumentActionOp $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $l = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null,
        DocumentActionGrant $grant = null,
        $zid = null
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $tag,
            $l,
            $rgb,
            $color,
            $name,
            $f,
            $t,
            $tn
        );
        if($grant instanceof DocumentActionGrant)
        {
            $this->_grant = $grant;
        }
        $this->_zid = trim($zid);
    }

    /**
     * Gets or sets op
     *
     * @param  DocumentActionOp $op
     * @return DocumentActionOp|self
     */
    public function op(DocumentActionOp $op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
    }

    /**
     * Gets or sets grant
     *
     * @param  DocumentActionGrant $grant
     * @return DocumentActionGrant|self
     */
    public function grant(DocumentActionGrant $grant = null)
    {
        if(null === $grant)
        {
            return $this->_grant;
        }
        $this->_grant = $grant;
        return $this;
    }

    /**
     * Gets or sets zid
     *
     * @param  string $zid
     * @return string|self
     */
    public function zid($zid = null)
    {
        if(null === $zid)
        {
            return $this->_zid;
        }
        $this->_zid = trim($zid);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $arr = parent::toArray($name);
        if(!empty($this->_zid))
        {
            $arr[$name]['zid'] = $this->_zid;
        }
        if($this->_grant instanceof DocumentActionGrant)
        {
            $arr[$name] += $this->_grant->toArray('grant');
        }

        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = parent::toXml($name);
        if(!empty($this->_zid))
        {
            $xml->addAttribute('zid', $this->_zid);
        }
        if($this->_grant instanceof DocumentActionGrant)
        {
            $xml->append($this->_grant->toXml('grant'));
        }
        return $xml;
    }
}
