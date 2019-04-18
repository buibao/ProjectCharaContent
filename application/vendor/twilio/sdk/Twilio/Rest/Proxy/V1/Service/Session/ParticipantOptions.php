<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Proxy\V1\Service\Session;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class ParticipantOptions {
    /**
     * @param string $identifier The identifier
     * @return ReadParticipantOptions Options builder
     */
    public static function read($identifier = Values::NONE) {
        return new ReadParticipantOptions($identifier);
    }

    /**
     * @param string $friendlyName A human readable description of this resource.
     * @param string $proxyIdentifier The proxy phone number to use for this
     *                                Participant.
     * @param string $proxyIdentifierSid The proxy_identifier_sid
     * @return CreateParticipantOptions Options builder
     */
    public static function create($friendlyName = Values::NONE, $proxyIdentifier = Values::NONE, $proxyIdentifierSid = Values::NONE) {
        return new CreateParticipantOptions($friendlyName, $proxyIdentifier, $proxyIdentifierSid);
    }

    /**
     * @param string $identifier The identifier
     * @param string $friendlyName The friendly_name
     * @param string $proxyIdentifier The proxy_identifier
     * @param string $proxyIdentifierSid The proxy_identifier_sid
     * @return UpdateParticipantOptions Options builder
     */
    public static function update($identifier = Values::NONE, $friendlyName = Values::NONE, $proxyIdentifier = Values::NONE, $proxyIdentifierSid = Values::NONE) {
        return new UpdateParticipantOptions($identifier, $friendlyName, $proxyIdentifier, $proxyIdentifierSid);
    }
}

class ReadParticipantOptions extends Options {
    /**
     * @param string $identifier The identifier
     */
    public function __construct($identifier = Values::NONE) {
        $this->options['identifier'] = $identifier;
    }

    /**
     * The identifier
     * 
     * @param string $identifier The identifier
     * @return $this Fluent Builder
     */
    public function setIdentifier($identifier) {
        $this->options['identifier'] = $identifier;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Proxy.V1.ReadParticipantOptions ' . implode(' ', $options) . ']';
    }
}

class CreateParticipantOptions extends Options {
    /**
     * @param string $friendlyName A human readable description of this resource.
     * @param string $proxyIdentifier The proxy phone number to use for this
     *                                Participant.
     * @param string $proxyIdentifierSid The proxy_identifier_sid
     */
    public function __construct($friendlyName = Values::NONE, $proxyIdentifier = Values::NONE, $proxyIdentifierSid = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['proxyIdentifier'] = $proxyIdentifier;
        $this->options['proxyIdentifierSid'] = $proxyIdentifierSid;
    }

    /**
     * A human readable description of this resource, up to 64 characters. Should not include PII.
     * 
     * @param string $friendlyName A human readable description of this resource.
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName) {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The proxy phone number to use for this Participant. If not specified, Proxy will select a number from the pool.
     * 
     * @param string $proxyIdentifier The proxy phone number to use for this
     *                                Participant.
     * @return $this Fluent Builder
     */
    public function setProxyIdentifier($proxyIdentifier) {
        $this->options['proxyIdentifier'] = $proxyIdentifier;
        return $this;
    }

    /**
     * The proxy_identifier_sid
     * 
     * @param string $proxyIdentifierSid The proxy_identifier_sid
     * @return $this Fluent Builder
     */
    public function setProxyIdentifierSid($proxyIdentifierSid) {
        $this->options['proxyIdentifierSid'] = $proxyIdentifierSid;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Proxy.V1.CreateParticipantOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateParticipantOptions extends Options {
    /**
     * @param string $identifier The identifier
     * @param string $friendlyName The friendly_name
     * @param string $proxyIdentifier The proxy_identifier
     * @param string $proxyIdentifierSid The proxy_identifier_sid
     */
    public function __construct($identifier = Values::NONE, $friendlyName = Values::NONE, $proxyIdentifier = Values::NONE, $proxyIdentifierSid = Values::NONE) {
        $this->options['identifier'] = $identifier;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['proxyIdentifier'] = $proxyIdentifier;
        $this->options['proxyIdentifierSid'] = $proxyIdentifierSid;
    }

    /**
     * The identifier
     * 
     * @param string $identifier The identifier
     * @return $this Fluent Builder
     */
    public function setIdentifier($identifier) {
        $this->options['identifier'] = $identifier;
        return $this;
    }

    /**
     * The friendly_name
     * 
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName) {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The proxy_identifier
     * 
     * @param string $proxyIdentifier The proxy_identifier
     * @return $this Fluent Builder
     */
    public function setProxyIdentifier($proxyIdentifier) {
        $this->options['proxyIdentifier'] = $proxyIdentifier;
        return $this;
    }

    /**
     * The proxy_identifier_sid
     * 
     * @param string $proxyIdentifierSid The proxy_identifier_sid
     * @return $this Fluent Builder
     */
    public function setProxyIdentifierSid($proxyIdentifierSid) {
        $this->options['proxyIdentifierSid'] = $proxyIdentifierSid;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Proxy.V1.UpdateParticipantOptions ' . implode(' ', $options) . ']';
    }
}