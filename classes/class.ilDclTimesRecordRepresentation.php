<?php
// Copyright (c) 2020 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Class ilDclTimesRecordRepresentation
 */
class ilDclTimesRecordRepresentation extends ilDclBaseRecordRepresentation {

    /**
     * function parses stored value to the variable needed to fill into the form for editing.
     *
     * @param $value
     * @return mixed
     * @see \ilDclTimesRecordFieldModel::parseValue
     * @see \ilDclGenericMultiInputGUI::insert
     */
    public function parseFormInput($value)
    {
        // ilDclGenericMultiInputGUI starts counting of its inputs with 2
        $i = 2;
        $times = [];
        foreach (explode(',', (string) $value) as $time) {
            $times[$i++] = [
                // ilDclGenericMultiInputGUI calls setValue() for all of its input
                // ilDayTimeInputGUI parses values like '08:23'
                'daytime' => trim($time)
            ];
        }
        return $times;
    }

}