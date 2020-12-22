<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\TestResultInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * RunUnitTestsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="RunUnitTestsResponse")
 */
class RunUnitTestsResponse implements ResponseInterface
{
    /**
     * Information about test results
     * @Accessor(getter="getResults", setter="setResults")
     * @SerializedName("results")
     * @Type("Zimbra\Admin\Struct\TestResultInfo")
     * @XmlElement
     */
    private $results;

    /**
     * Number of executed tests
     * @Accessor(getter="getNumExecuted", setter="setNumExecuted")
     * @SerializedName("numExecuted")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numExecuted;

    /**
     * Number of failed tests
     * @Accessor(getter="getNumFailed", setter="setNumFailed")
     * @SerializedName("numFailed")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numFailed;

    /**
     * Constructor method for RunUnitTestsResponse
     * 
     * @param TestResultInfo $results
     * @param int $numExecuted
     * @param int $numFailed
     * @return self
     */
    public function __construct(
    	TestResultInfo $results,
        int $numExecuted,
        int $numFailed)
    {
        $this->setResults($results)
        	 ->setNumExecuted($numExecuted)
        	 ->setNumFailed($numFailed);
    }

    /**
     * Gets results
     *
     * @return string
     */
    public function getResults(): TestResultInfo
    {
        return $this->results;
    }

    /**
     * Sets results
     *
     * @param  TestResultInfo $results
     * @return self
     */
    public function setResults(TestResultInfo $results): self
    {
        $this->results = $results;
        return $this;
    }

    /**
     * Gets numExecuted
     *
     * @return int
     */
    public function getNumExecuted(): int
    {
        return $this->numExecuted;
    }

    /**
     * Sets numExecuted
     *
     * @param  int $numExecuted
     * @return self
     */
    public function setNumExecuted(int $numExecuted): self
    {
        $this->numExecuted = $numExecuted;
        return $this;
    }

    /**
     * Gets numFailed
     *
     * @return int
     */
    public function getNumFailed(): int
    {
        return $this->numFailed;
    }

    /**
     * Sets numFailed
     *
     * @param  int $numFailed
     * @return self
     */
    public function setNumFailed(int $numFailed): self
    {
        $this->numFailed = $numFailed;
        return $this;
    }
}
