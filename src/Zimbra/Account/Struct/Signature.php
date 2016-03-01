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
     * Content of the signature sequence
     * @var TypedSequence<SignatureContent>
     */
    private $_contents;

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
        array $contents = []
	)
    {
		parent::__construct();
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $cid)
        {
            $this->setChild('cid', trim($cid));
        }
        $this->setContent($contents);

        $this->on('before', function(Base $sender)
        {
            if($sender->getContents()->count())
            {
                $sender->setChild('content', $sender->getContents()->all());
            }
        });
    }

    /**
     * Gets ID for the signature
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ID for the signature
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets name for the signature
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name for the signature
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets contact ID
     *
     * @return string
     */
    public function getCid()
    {
        return $this->getChild('cid');
    }

    /**
     * Sets contact ID
     *
     * @param  string $cid
     * @return self
     */
    public function setCid($cid)
    {
        return $this->setChild('cid', trim($cid));
    }

    /**
     * Add a signature content
     *
     * @param  SignatureContent $content
     * @return self
     */
    public function addContent(SignatureContent $content)
    {
        $this->_contents->add($content);
        return $this;
    }

    /**
     * Sets signature content sequence
     *
     * @param array  $contents
     * @return self
     */
    public function setContent(array $contents)
    {
        $this->_contents = new TypedSequence('Zimbra\Account\Struct\SignatureContent', $contents);
        return $this;
    }

    /**
     * Gets signature content sequence
     *
     * @return Sequence
     */
    public function getContents()
    {
        return $this->_contents;
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
