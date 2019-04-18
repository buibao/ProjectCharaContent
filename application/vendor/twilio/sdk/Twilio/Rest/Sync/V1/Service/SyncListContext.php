<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Rest\Sync\V1\Service\SyncList\SyncListItemList;
use Twilio\Rest\Sync\V1\Service\SyncList\SyncListPermissionList;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 * 
 * @property \Twilio\Rest\Sync\V1\Service\SyncList\SyncListItemList syncListItems
 * @property \Twilio\Rest\Sync\V1\Service\SyncList\SyncListPermissionList syncListPermissions
 * @method \Twilio\Rest\Sync\V1\Service\SyncList\SyncListItemContext syncListItems(integer $index)
 * @method \Twilio\Rest\Sync\V1\Service\SyncList\SyncListPermissionContext syncListPermissions(string $identity)
 */
class SyncListContext extends InstanceContext {
    protected $_syncListItems = null;
    protected $_syncListPermissions = null;

    /**
     * Initialize the SyncListContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $serviceSid The service_sid
     * @param string $sid The sid
     * @return \Twilio\Rest\Sync\V1\Service\SyncListContext 
     */
    public function __construct(Version $version, $serviceSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('serviceSid' => $serviceSid, 'sid' => $sid, );

        $this->uri = '/Services/' . rawurlencode($serviceSid) . '/Lists/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a SyncListInstance
     * 
     * @return SyncListInstance Fetched SyncListInstance
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new SyncListInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['sid']
        );
    }

    /**
     * Deletes the SyncListInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Update the SyncListInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return SyncListInstance Updated SyncListInstance
     */
    public function update($options = array()) {
        $options = new Values($options);

        $data = Values::of(array('Ttl' => $options['ttl'], ));

        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new SyncListInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['sid']
        );
    }

    /**
     * Access the syncListItems
     * 
     * @return \Twilio\Rest\Sync\V1\Service\SyncList\SyncListItemList 
     */
    protected function getSyncListItems() {
        if (!$this->_syncListItems) {
            $this->_syncListItems = new SyncListItemList(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->_syncListItems;
    }

    /**
     * Access the syncListPermissions
     * 
     * @return \Twilio\Rest\Sync\V1\Service\SyncList\SyncListPermissionList 
     */
    protected function getSyncListPermissions() {
        if (!$this->_syncListPermissions) {
            $this->_syncListPermissions = new SyncListPermissionList(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->_syncListPermissions;
    }

    /**
     * Magic getter to lazy load subresources
     * 
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     * 
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
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
        return '[Twilio.Sync.V1.SyncListContext ' . implode(' ', $context) . ']';
    }
}