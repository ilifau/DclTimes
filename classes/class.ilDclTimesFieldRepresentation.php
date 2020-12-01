<?php
// Copyright (c) 2020 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Class ilDclTimesFieldRepresentation
 */
class ilDclTimesFieldRepresentation extends ilDclPluginFieldRepresentation
{

    /**
     * Get the property form input field for records
	 * @param ilPropertyFormGUI $form
	 * @param int               $record_id
	 *
	 * @return ilDclGenericMultiInputGUI
	 */
	public function getInputField(ilPropertyFormGUI $form, $record_id = 0)
    {
        require_once(__DIR__ . '/class.ilDayTimeInputGUI.php');
        $timeInput = new ilDayTimeInputGUI('lng_date', 'daytime');

        $input = new ilDclGenericMultiInputGUI($this->getField()->getTitle(), 'field_' . $this->getField()->getId());
        $input->setMulti(true);
        $input->addInput($timeInput);
        $this->setupInputField($input, $this->getField());

		return $input;
	}
}