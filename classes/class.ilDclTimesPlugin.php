<?php
// Copyright (c) 2020 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Class ilDclTimesPlugin
 */
class ilDclTimesPlugin extends ilDclFieldTypePlugin {

	/**
	 * Get Plugin Name. Must be same as in class name il<Name>Plugin
	 * and must correspond to plugins subdirectory name.
	 *
	 * Must be overwritten in plugin class of plugin
	 *
	 * @return    string    Plugin Name
	 */
	public function getPluginName() {
		return "DclTimes";
	}

    /**
     * Get a plugin text and ignore empty variables
     *
     * @param string $a_var
     * @return string
     */
	public function txt(string $a_var) : string
    {
        $txt = parent::txt($a_var);
        if (substr($txt, 0, 5) == '-dcl_') {
            return '';
        }
        return $txt;
    }
}