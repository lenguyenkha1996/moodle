<?php
$settings->add(new admin_setting_heading(
            'headerconfig',
            get_string('headerconfig', 'block_addfunctions'),
            get_string('descconfig', 'block_addfunctions')
        ));
 
$settings->add(new admin_setting_configcheckbox(
            'addfunctions/Set_Background',
            get_string('labelallowhtml', 'block_addfunctions'),
            get_string('descallowhtml', 'block_addfunctions'),
            '0'
        ));
?>