<?php
// Copyright (c) 2020 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

class ilDayTimeInputGUI extends ilFormPropertyGUI
{
    /** @var ilDclTimesPlugin  */
    protected $plugin;

    protected $hours = null;
    protected $minutes = null;

    /**
     * Constructor
     *
     * @param	string	$a_title	Title
     * @param	string	$a_postvar	Post Variable
     * @param   ilPlugin   $a_plugin
     */
    public function __construct($a_title = "", $a_postvar = "")
    {
        require_once(__DIR__ . '/class.ilDclTimesPlugin.php');
        $this->plugin = ilDclTimesPlugin::getInstance();

        parent::__construct($a_title, $a_postvar);
        $this->setType("daytime");
    }


    /**
     * Set Hours.
     *
     * @param int|null $a_hours	Hours
     */
    public function setHours($a_hours)
    {
        $this->hours = $a_hours;
    }

    /**
     * Get Hours.
     *
     * @return	int|null	Hours
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set Minutes.
     *
     * @param int|null	$a_minutes	Minutes
     */
    public function setMinutes($a_minutes)
    {
        $this->minutes = $a_minutes;
    }

    /**
     * Get Minutes.
     *
     * @return int|null	Minutes
     */
    public function getMinutes()
    {
        return $this->minutes;
    }


    /**
     * Set value by array
     *
     * @param	array	$a_values	value array
     */
    public function setValueByArray($a_values)
    {
        $this->setHours($a_values[$this->getPostVar()]["hh"]);
        $this->setMinutes($a_values[$this->getPostVar()]["mm"]);
    }

    /**
     * Check input, strip slashes etc. set alert, if input is not ok.
     *
     * @return	boolean		Input ok, true/false
     */
    public function checkInput()
    {
        $_POST[$this->getPostVar()]["hh"] = ilUtil::stripSlashes($_POST[$this->getPostVar()]["hh"]);
        $_POST[$this->getPostVar()]["mm"] = ilUtil::stripSlashes($_POST[$this->getPostVar()]["mm"]);
        return true;
    }

    /**
     * Insert property html
     *
     */
    public function render()
    {
        $tpl = $this->plugin->getTemplate("tpl.daytime.html", true, true);

        $tpl->setVariable("TXT_PREFIX", $this->plugin->txt('prefix'));
        $tpl->setVariable("TXT_DELIM", $this->plugin->txt('delim'));
        $tpl->setVariable("TXT_SUFFIX", $this->plugin->txt('suffix'));

        $val =  ['  ' => '--'];
        for ($i = 0; $i <= 23; $i++) {
            $val[sprintf("%02d", $i)] = sprintf("%02d", $i);
        }
        $tpl->setVariable(
            "SELECT_HOURS",
            ilUtil::formSelect(
                $this->getHours(),
                $this->getPostVar() . "[hh]",
                $val,
                false,
                true,
                0,
                '',
                '',
                $this->getDisabled()
            )
        );

        $val =  ['  ' => '--'];
        for ($i = 0; $i <= 59; $i = $i + 5) {
            $val[sprintf("%02d", $i)] = sprintf("%02d", $i);
        }
        $tpl->setVariable(
            "SELECT_MINUTES",
            ilUtil::formSelect(
                $this->getMinutes(),
                $this->getPostVar() . "[mm]",
                $val,
                false,
                true,
                0,
                '',
                '',
                $this->getDisabled()
            )
        );

        return $tpl->get();
    }

    /**
     * Serialize data
     */
    public function serializeData()
    {
        $data = array( "hours" => $this->getHours(),
                       "minutes" => $this->getMinutes());

        return serialize($data);
    }

    /**
     * Unserialize data
     */
    public function unserializeData($a_data)
    {
        $data = unserialize($a_data);

        $this->setHours($data["hours"]);
        $this->setMinutes($data["minutes"]);
    }


    /**
     * Get the value as string (format 08:23)
     * @return string
     */
    public function getValue()
    {
        return sprintf("%02d:%02d", $this->getHours(), $this->getMinutes());
    }

    /**
     * Set the value as string (format 08:23)
     * @var string
     */
    public function setValue($a_value)
    {
        $parts = explode(':', (string) $a_value);
        $this->setHours($parts[0]);
        $this->setMinutes($parts[1]);
    }
}