<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Video\V1\Room;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string accountSid
 * @property string status
 * @property \DateTime dateCreated
 * @property string sid
 * @property string sourceSid
 * @property string size
 * @property string url
 * @property string type
 * @property integer duration
 * @property string containerFormat
 * @property string codec
 * @property array groupingSids
 * @property string trackName
 * @property string roomSid
 * @property array links
 */
class RoomRecordingInstance extends InstanceResource {
    /**
     * Initialize the RoomRecordingInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $roomSid The room_sid
     * @param string $sid The sid
     * @return \Twilio\Rest\Video\V1\Room\RoomRecordingInstance 
     */
    public function __construct(Version $version, array $payload, $roomSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'status' => Values::array_get($payload, 'status'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'sid' => Values::array_get($payload, 'sid'),
            'sourceSid' => Values::array_get($payload, 'source_sid'),
            'size' => Values::array_get($payload, 'size'),
            'url' => Values::array_get($payload, 'url'),
            'type' => Values::array_get($payload, 'type'),
            'duration' => Values::array_get($payload, 'duration'),
            'containerFormat' => Values::array_get($payload, 'container_format'),
            'codec' => Values::array_get($payload, 'codec'),
            'groupingSids' => Values::array_get($payload, 'grouping_sids'),
            'trackName' => Values::array_get($payload, 'track_name'),
            'roomSid' => Values::array_get($payload, 'room_sid'),
            'links' => Values::array_get($payload, 'links'),
        );

        $this->solution = array('roomSid' => $roomSid, 'sid' => $sid ?: $this->properties['sid'], );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Video\V1\Room\RoomRecordingContext Context for this
     *                                                         RoomRecordingInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new RoomRecordingContext(
                $this->version,
                $this->solution['roomSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a RoomRecordingInstance
     * 
     * @return RoomRecordingInstance Fetched RoomRecordingInstance
     */
    public function fetch() {
        return $this->proxy()->fetch();
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
        return '[Twilio.Video.V1.RoomRecordingInstance ' . implode(' ', $context) . ']';
    }
}