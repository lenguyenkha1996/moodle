<?php
require_once("{$CFG->libdir}/formslib.php");
 
class addfunctions_form extends moodleform {
 
    function definition() {
        $mform =& $this->_form;
        $mform->addElement('header','displayinfo', get_string('tieude1', 'block_addfunctions'));
        // add filename selection.
        $mform->addElement('hidden', 'blockid');
        $mform->setType('blockid', PARAM_RAW);
        $mform->addRule('blockid', null, 'required', null, 'client');
        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid', PARAM_RAW);
        $mform->addRule('courseid', null, 'required', null, 'client');
        
        $mform->addElement('filepicker', 'filename', get_string('file'), null, array('accepted_types' => '*'));
        $this->add_action_buttons();
    }
}
?>