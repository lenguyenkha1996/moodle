<?php
    class block_addfunctions extends block_base{
        public function init(){
            $this->title= get_string('addfunctions', 'block_addfunctions');
        }
        public function get_content() {
            if ($this->content !== null) {
              return $this->content;
            }
         
            $this->content         =  new stdClass;
            //$this->content->text   = 'Đây là block thêm chức năng';

            if (! empty($this->config->text)) {
                $this->content->text = $this->config->text;
            }
            //$this->content->footer = 'Đây là phần footer';
            global $COURSE;
            // The other code.
            $url_uploaduser = new moodle_url('/admin/tool/uploaduser/index.php');
            $url_uploadcourse = new moodle_url('/admin/tool/uploadcourse/index.php');
            // $url_themcauhoi = new moodle_url('/question/import.php', array('courseid' => $COURSE->id));
            // $url = new moodle_url('/blocks/addfunctions/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
            
            // $footer = html_writer::link($url_themcauhoi, 'Thêm câu hỏi');
            $footer .= '<img class="icon " alt="" src="http://35.190.179.108/theme/image.php/aardvark/core/1537852123/i/settings" tabindex="-1">'.html_writer::link($url_uploaduser, get_string('uploaduser', 'block_addfunctions'));
            $footer .= '<br>'.'<img class="icon " alt="" src="http://35.190.179.108/theme/image.php/aardvark/core/1537852123/i/settings" tabindex="-1">'.html_writer::link($url_uploadcourse, get_string('uploadcourse', 'block_addfunctions'));
            // $footer .= '<br>'.html_writer::link($url, get_string('huongdan', 'block_addfunctions'));
            $this->content->footer = $footer;
         
            return $this->content;
        }
        public function specialization() {
            if (isset($this->config)) {
                if (empty($this->config->title)) {
                    $this->title = get_string('tieudematdinh', 'block_addfunctions');            
                } else {
                    $this->title = $this->config->title;
                }
         
                if (empty($this->config->text)) {
                    $this->config->text = get_string('noidungmatdinh', 'block_addfunctions');
                }    
            }
        }
        public function instance_allow_multiple() {
            return true;
          }
          function has_config() {return true;}
    }
?>