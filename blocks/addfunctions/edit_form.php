<?php
 
class block_addfunctions_edit_form extends block_edit_form {
 
protected function specific_definition($mform) {
    global $CFG;

        // Section header title according to language file.
    // $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));
 
        //Chỉnh sửa nội dung
    // $mform->addElement('text', 'config_text', get_string('noidung', 'block_addfunctions'));
    // $mform->setDefault('config_text', 'default value');
    // $mform->setType('config_text', PARAM_RAW);
        //Chỉnh sửa tiêu đề
        
    // $mform->addElement('text', 'config_title', get_string('tieude', 'block_addfunctions'));
    // $mform->setDefault('config_title', 'default value');
    // $mform->setType('config_title', PARAM_TEXT);     
 
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('configtitle', 'block_addfunctions'));
        $mform->setType('config_title', PARAM_TEXT);

        $editoroptions = array('maxfiles' => EDITOR_UNLIMITED_FILES, 'noclean'=>true, 'context'=>$this->block->context);
        $mform->addElement('editor', 'config_text', get_string('configcontent', 'block_addfunctions'), null, $editoroptions);
        $mform->addRule('config_text', null, 'required', null, 'client');
        $mform->setType('config_text', PARAM_RAW); // XSS is prevented when printing the block contents and serving files

        if (!empty($CFG->block_html_allowcssclasses)) {
            $mform->addElement('text', 'config_classes', get_string('configclasses', 'block_addfunctions'));
            $mform->setType('config_classes', PARAM_TEXT);
            $mform->addHelpButton('config_classes', 'configclasses', 'block_addfunctions');
        }
    }

    function set_data($defaults) {
        if (!empty($this->block->config) && is_object($this->block->config)) {
            $text = $this->block->config->text;
            $draftid_editor = file_get_submitted_draft_itemid('config_text');
            if (empty($text)) {
                $currenttext = '';
            } else {
                $currenttext = $text;
            }
            $defaults->config_text['text'] = file_prepare_draft_area($draftid_editor, $this->block->context->id, 'block_addfunctions', 'content', 0, array('subdirs'=>true), $currenttext);
            $defaults->config_text['itemid'] = $draftid_editor;
            $defaults->config_text['format'] = $this->block->config->format;
        } else {
            $text = '';
        }

        if (!$this->block->user_can_edit() && !empty($this->block->config->title)) {
            // If a title has been set but the user cannot edit it format it nicely
            $title = $this->block->config->title;
            $defaults->config_title = format_string($title, true, $this->page->context);
            // Remove the title from the config so that parent::set_data doesn't set it.
            unset($this->block->config->title);
        }

        // have to delete text here, otherwise parent::set_data will empty content
        // of editor
        unset($this->block->config->text);
        parent::set_data($defaults);
        // restore $text
        if (!isset($this->block->config)) {
            $this->block->config = new stdClass();
        }
        $this->block->config->text = $text;
        if (isset($title)) {
            // Reset the preserved title
            $this->block->config->title = $title;
        }
    }
}
?>