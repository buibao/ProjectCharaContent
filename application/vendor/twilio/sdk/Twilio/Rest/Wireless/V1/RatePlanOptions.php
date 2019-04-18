<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Wireless\V1;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class RatePlanOptions {
    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     * @param boolean $dataEnabled The data_enabled
     * @param integer $dataLimit The data_limit
     * @param string $dataMetering The data_metering
     * @param boolean $messagingEnabled The messaging_enabled
     * @param boolean $voiceEnabled The voice_enabled
     * @param boolean $nationalRoamingEnabled The national_roaming_enabled
     * @param string $internationalRoaming The international_roaming
     * @param integer $nationalRoamingDataLimit The national_roaming_data_limit
     * @param integer $internationalRoamingDataLimit The
     *                                               international_roaming_data_limit
     * @return CreateRatePlanOptions Options builder
     */
    public static function create($uniqueName = Values::NONE, $friendlyName = Values::NONE, $dataEnabled = Values::NONE, $dataLimit = Values::NONE, $dataMetering = Values::NONE, $messagingEnabled = Values::NONE, $voiceEnabled = Values::NONE, $nationalRoamingEnabled = Values::NONE, $internationalRoaming = Values::NONE, $nationalRoamingDataLimit = Values::NONE, $internationalRoamingDataLimit = Values::NONE) {
        return new CreateRatePlanOptions($uniqueName, $friendlyName, $dataEnabled, $dataLimit, $dataMetering, $messagingEnabled, $voiceEnabled, $nationalRoamingEnabled, $internationalRoaming, $nationalRoamingDataLimit, $internationalRoamingDataLimit);
    }

    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     * @return UpdateRatePlanOptions Options builder
     */
    public static function update($uniqueName = Values::NONE, $friendlyName = Values::NONE) {
        return new UpdateRatePlanOptions($uniqueName, $friendlyName);
    }
}

class CreateRatePlanOptions extends Options {
    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     * @param boolean $dataEnabled The data_enabled
     * @param integer $dataLimit The data_limit
     * @param string $dataMetering The data_metering
     * @param boolean $messagingEnabled The messaging_enabled
     * @param boolean $voiceEnabled The voice_enabled
     * @param boolean $nationalRoamingEnabled The national_roaming_enabled
     * @param string $internationalRoaming The international_roaming
     * @param integer $nationalRoamingDataLimit The national_roaming_data_limit
     * @param integer $internationalRoamingDataLimit The
     *                                               international_roaming_data_limit
     */
    public function __construct($uniqueName = Values::NONE, $friendlyName = Values::NONE, $dataEnabled = Values::NONE, $dataLimit = Values::NONE, $dataMetering = Values::NONE, $messagingEnabled = Values::NONE, $voiceEnabled = Values::NONE, $nationalRoamingEnabled = Values::NONE, $internationalRoaming = Values::NONE, $nationalRoamingDataLimit = Values::NONE, $internationalRoamingDataLimit = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['dataEnabled'] = $dataEnabled;
        $this->options['dataLimit'] = $dataLimit;
        $this->options['dataMetering'] = $dataMetering;
        $this->options['messagingEnabled'] = $messagingEnabled;
        $this->options['voiceEnabled'] = $voiceEnabled;
        $this->options['nationalRoamingEnabled'] = $nationalRoamingEnabled;
        $this->options['internationalRoaming'] = $internationalRoaming;
        $this->options['nationalRoamingDataLimit'] = $nationalRoamingDataLimit;
        $this->options['internationalRoamingDataLimit'] = $internationalRoamingDataLimit;
    }

    /**
     * The unique_name
     * 
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName) {
        $this->options['uniqueName'] = $uniqueName;
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
     * The data_enabled
     * 
     * @param boolean $dataEnabled The data_enabled
     * @return $this Fluent Builder
     */
    public function setDataEnabled($dataEnabled) {
        $this->options['dataEnabled'] = $dataEnabled;
        return $this;
    }

    /**
     * The data_limit
     * 
     * @param integer $dataLimit The data_limit
     * @return $this Fluent Builder
     */
    public function setDataLimit($dataLimit) {
        $this->options['dataLimit'] = $dataLimit;
        return $this;
    }

    /**
     * The data_metering
     * 
     * @param string $dataMetering The data_metering
     * @return $this Fluent Builder
     */
    public function setDataMetering($dataMetering) {
        $this->options['dataMetering'] = $dataMetering;
        return $this;
    }

    /**
     * The messaging_enabled
     * 
     * @param boolean $messagingEnabled The messaging_enabled
     * @return $this Fluent Builder
     */
    public function setMessagingEnabled($messagingEnabled) {
        $this->options['messagingEnabled'] = $messagingEnabled;
        return $this;
    }

    /**
     * The voice_enabled
     * 
     * @param boolean $voiceEnabled The voice_enabled
     * @return $this Fluent Builder
     */
    public function setVoiceEnabled($voiceEnabled) {
        $this->options['voiceEnabled'] = $voiceEnabled;
        return $this;
    }

    /**
     * The national_roaming_enabled
     * 
     * @param boolean $nationalRoamingEnabled The national_roaming_enabled
     * @return $this Fluent Builder
     */
    public function setNationalRoamingEnabled($nationalRoamingEnabled) {
        $this->options['nationalRoamingEnabled'] = $nationalRoamingEnabled;
        return $this;
    }

    /**
     * The international_roaming
     * 
     * @param string $internationalRoaming The international_roaming
     * @return $this Fluent Builder
     */
    public function setInternationalRoaming($internationalRoaming) {
        $this->options['internationalRoaming'] = $internationalRoaming;
        return $this;
    }

    /**
     * The national_roaming_data_limit
     * 
     * @param integer $nationalRoamingDataLimit The national_roaming_data_limit
     * @return $this Fluent Builder
     */
    public function setNationalRoamingDataLimit($nationalRoamingDataLimit) {
        $this->options['nationalRoamingDataLimit'] = $nationalRoamingDataLimit;
        return $this;
    }

    /**
     * The international_roaming_data_limit
     * 
     * @param integer $internationalRoamingDataLimit The
     *                                               international_roaming_data_limit
     * @return $this Fluent Builder
     */
    public function setInternationalRoamingDataLimit($internationalRoamingDataLimit) {
        $this->options['internationalRoamingDataLimit'] = $internationalRoamingDataLimit;
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
        return '[Twilio.Wireless.V1.CreateRatePlanOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateRatePlanOptions extends Options {
    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     */
    public function __construct($uniqueName = Values::NONE, $friendlyName = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * The unique_name
     * 
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName) {
        $this->options['uniqueName'] = $uniqueName;
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
        return '[Twilio.Wireless.V1.UpdateRatePlanOptions ' . implode(' ', $options) . ']';
    }
}