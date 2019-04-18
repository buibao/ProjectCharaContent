<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string accountSid
 * @property string apiVersion
 * @property \DateTime dateCreated
 * @property \DateTime dateUpdated
 * @property string friendlyName
 * @property string messageStatusCallback
 * @property string sid
 * @property string smsFallbackMethod
 * @property string smsFallbackUrl
 * @property string smsMethod
 * @property string smsStatusCallback
 * @property string smsUrl
 * @property string statusCallback
 * @property string statusCallbackMethod
 * @property string uri
 * @property boolean voiceCallerIdLookup
 * @property string voiceFallbackMethod
 * @property string voiceFallbackUrl
 * @property string voiceMethod
 * @property string voiceUrl
 */
class ApplicationInstance extends InstanceResource {
    /**
     * Initialize the ApplicationInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid A string that uniquely identifies this resource
     * @param string $sid Fetch by unique Application Sid
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationInstance 
     */
    public function __construct(Version $version, array $payload, $accountSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'apiVersion' => Values::array_get($payload, 'api_version'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'messageStatusCallback' => Values::array_get($payload, 'message_status_callback'),
            'sid' => Values::array_get($payload, 'sid'),
            'smsFallbackMethod' => Values::array_get($payload, 'sms_fallback_method'),
            'smsFallbackUrl' => Values::array_get($payload, 'sms_fallback_url'),
            'smsMethod' => Values::array_get($payload, 'sms_method'),
            'smsStatusCallback' => Values::array_get($payload, 'sms_status_callback'),
            'smsUrl' => Values::array_get($payload, 'sms_url'),
            'statusCallback' => Values::array_get($payload, 'status_callback'),
            'statusCallbackMethod' => Values::array_get($payload, 'status_callback_method'),
            'uri' => Values::array_get($payload, 'uri'),
            'voiceCallerIdLookup' => Values::array_get($payload, 'voice_caller_id_lookup'),
            'voiceFallbackMethod' => Values::array_get($payload, 'voice_fallback_method'),
            'voiceFallbackUrl' => Values::array_get($payload, 'voice_fallback_url'),
            'voiceMethod' => Values::array_get($payload, 'voice_method'),
            'voiceUrl' => Values::array_get($payload, 'voice_url'),
        );

        $this->solution = array('accountSid' => $accountSid, 'sid' => $sid ?: $this->properties['sid'], );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationContext Context for this
     *                                                           ApplicationInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new ApplicationContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Deletes the ApplicationInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->proxy()->delete();
    }

    /**
     * Fetch a ApplicationInstance
     * 
     * @return ApplicationInstance Fetched ApplicationInstance
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Update the ApplicationInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return ApplicationInstance Updated ApplicationInstance
     */
    public function update($options = array()) {
        return $this->proxy()->update($options);
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
        return '[Twilio.Api.V2010.ApplicationInstance ' . implode(' ', $context) . ']';
    }
}