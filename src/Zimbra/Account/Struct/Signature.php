<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * Signature struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Signature extends Base
{
    /**
     * ID for the signature
     * @var string
     */
    private $_id;

    /**
     * Name for the signature
     * @var string
     */
    private $_name;

    /**
     * Contact ID
     * @var string
     */
    private $_cid;

    /**
     * Content of the signature sequence
     * @var TypedSequence<SignatureContent>
     */
    private $_content = array();

    /**
     * Constructor method for signature
     * @param string $name
     * @param string $id
     * @param string $cid
     * @param array  $contents
     * @return self
     */
    public function __construct(
        $name = null,
        $id = null,
        $cid = null,
        array $contents = array()
	)
    {
		parent::__construct();
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $cid)
        {
            $this->child('cid', trim($cid));
        }
        $this->_content = new TypedSequence('Zimbra\Account\Struct\SignatureContent', $contents);

        $this->addHook(function($sender)
        {
            $sender->child('content', $sender->content()->all());
        });
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets cid
     *
     * @param  string $cid
     * @return string|self
     */
    public function cid($cid = null)
    {
        if(null === $cid)
        {
            return $this->child('cid');
        }
        return $this->child('cid', trim($cid));
    }

    /**
     * Add a signature content
     *
     * @param  SignatureContent $content
     * @return self
     */
    public function addContent(SignatureContent $content)
    {
        $this->_content->add($content);
        return $this;
    }

    /**
     * Gets signature content sequence
     *
     * @return Sequence
     */
    public function content()
    {
        return $this->_content;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'signature')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'signature')
    {
        return parent::toXml($name);
    }
}
