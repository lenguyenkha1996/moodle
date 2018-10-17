<?php
 
require_once('../../config.php');
require_once('addfunctions_form.php');
require_once($CFG->dirroot.'/mod/quiz/mod_form.php');
 
global $DB, $OUTPUT, $PAGE;
// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);
 
// Next look for optional variables.
$id = optional_param('id', 0, PARAM_INT);
 
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_simplehtml', $courseid);
}
 
require_login($course);
$PAGE->set_url('/blocks/addfunctions/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('tieudetrang', 'block_addfunctions'));

$settingsnode = $PAGE->settingsnav->add(get_string('themchucnangsettings', 'block_addfunctions'));
$editurl = new moodle_url('/blocks/addfunctions/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_addfunctions'), $editurl);
$editnode->make_active();
//$output = $PAGE->get_renderer('block_themchucnang');
//$renderable = new \block_themchucnang\output\index_page('Some text');
//echo $OUTPUT->header();
//echo $OUTPUT->render($renderable);
//echo $OUTPUT->footer();
$simplehtml = new addfunctions_form();
//$course = $DB->get_record('course', array('id' => $courseid));
//$info = get_fast_modinfo($course);
//print_r($info);
//$simplehtml = new mod_quiz_mod_form(1, 2, 'quiz', $courseid);
$toform['blockid'] = $blockid;
$toform['courseid'] = $courseid;
$simplehtml->set_data($toform);
if($simplehtml->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $id));
    redirect($courseurl);
} else if ($fromform = $simplehtml->get_data()) {
    // We need to add code to appropriately act on and store the submitted data
    // but for now we will just redirect back to the course main page.
    // $courseurl = new moodle_url('/course/view.php', array('id' => $courseid));
    // redirect($courseurl);
    // print_object($simplehtml->get_file_content('filename'));
    $user = $DB->get_records('question');
    print_object($user);
} else {
    // form didn't validate or this is the first display

    $site = get_site();
    echo $OUTPUT->header();
    $simplehtml->display();
    echo $OUTPUT->footer();
}
?>