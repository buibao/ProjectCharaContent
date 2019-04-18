<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Studio\Flow\Engagement;

use Twilio\InstanceContext;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class StepContext extends InstanceContext {
    /**
     * Initialize the StepContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $flowSid The flow_sid
     * @param string $engagementSid The engagement_sid
     * @param string $sid The sid
     * @return \Twilio\Rest\Preview\Studio\Flow\Engagement\StepContext 
     */
    public function __construct(Version $version, $flowSid, $engagementSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('flowSid' => $flowSid, 'engagementSid' => $engagementSid, 'sid' => $sid, );

        $this->uri = '/Flows/' . rawurlencode($flowSid) . '/Engagements/' . rawurlencode($engagementSid) . '/Steps/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a StepInstance
     * 
     * @return StepInstance Fetched StepInstance
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new StepInstance(
            $this->version,
            $payload,
            $this->solution['flowSid'],
            $this->solution['engagementSid'],
            $this->solution['sid']
        );
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.Studio.StepContext ' . implode(' ', $context) . ']';
    }
}