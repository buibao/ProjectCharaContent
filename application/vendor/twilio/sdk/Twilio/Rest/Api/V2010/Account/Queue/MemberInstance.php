<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Queue;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string callSid
 * @property \DateTime dateEnqueued
 * @property integer position
 * @property string uri
 * @property integer waitTime
 */
class MemberInstance extends InstanceResource {
    /**
     * Initialize the MemberInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The account_sid
     * @param string $queueSid A string that uniquely identifies this queue
     * @param string $callSid The call_sid
     * @return \Twilio\Rest\Api\V2010\Account\Queue\MemberInstance 
     */
    public function __construct(Version $version, array $payload, $accountSid, $queueSid, $callSid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'callSid' => Values::array_get($payload, 'call_sid'),
            'dateEnqueued' => Deserialize::dateTime(Values::array_get($payload, 'date_enqueued')),
            'position' => Values::array_get($payload, 'position'),
            'uri' => Values::array_get($payload, 'uri'),
            'waitTime' => Values::array_get($payload, 'wait_time'),
        );

        $this->solution = array(
            'accountSid' => $accountSid,
            'queueSid' => $queueSid,
            'callSid' => $callSid ?: $this->properties['callSid'],
        );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Api\V2010\Account\Queue\MemberContext Context for this
     *                                                            MemberInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new MemberContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['queueSid'],
                $this->solution['callSid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a MemberInstance
     * 
     * @return MemberInstance Fetched MemberInstance
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Update the MemberInstance
     * 
     * @param string $url The url
     * @param string $method The method
     * @return MemberInstance Updated MemberInstance
     */
    public function update($url, $method) {
        return $this->proxy()->update($url, $method);
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Api.V2010.MemberInstance ' . implode(' ', $context) . ']';
    }
}