ILIAS Data Collection Field for Multiple Day Times Input
========================================================

Installation
------------
When you download the Plugin as ZIP file from GitHub, please rename the extracted directory to *DclTimes* (remove the branch suffix, e.g. -main).

1. Copy the DclTimes directory to your ILIAS installation at the following path (create subdirectories, if neccessary):
Customizing/global/plugins/Modules/DataCollection/FieldTypeHook
2. Go to Administration > Plugins
3. Choose "Install" for the DclTimes plugin
4. Choose "Activate" for the DclTimes plugin

There is nothing to configure for this plugin.

Usage
-----
This plugin provides a new field type for ILIAS data collection. When a new field is created, the option "Plugin" will show a selection "DclTimes".
This fields allows the input of multiple day times by selecting the our and the minute (with 5 minute steps).
The entered values are stored and presented as a comma separated list of times like '08:20, 09:40, 10:50'

