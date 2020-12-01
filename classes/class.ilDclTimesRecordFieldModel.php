<?php
// Copyright (c) 2020 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Class ilDclTimesRecordFieldModel
 */
class ilDclTimesRecordFieldModel extends ilDclPluginRecordFieldModel
{
	// here you could override record-value logic (e.g. Excel-Export formating, other storage-location mechanisms)

    /**
     * Function to parse incoming data from form input value $value. returns the string/number/etc. to store in the database.
     *
     * @param $value
     * @return int|string
     * @see \ilDclTimesRecordRepresentation::parseFormInput
     */
    public function parseValue($value)
    {
        $times = [];
        foreach ((array) $value as $entry) {

            $hour = trim($entry['daytime']['hh']);
            $minute = trim($entry['daytime']['mm']);

            if ($hour != '') {
                $times[] = sprintf('%02d:%02d', (int) $hour, (int) $minute);
            }
        }
        sort($times);
        return implode(', ', $times);
    }
}