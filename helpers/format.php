<?php

class Format {

    public function formatDate($date) {
        return date('F j,Y,g:i a', strtotime($date));
    }

    public function textShort($data, $limit = 400) {
        $text = substr($data, 0, $limit);
        $text = substr($data, 0, strrpos($text, ' ')) . '...'; //use strrpos for prevent word broken
        return $text;
    }

    public function validation($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function title() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        if ($title == 'index') {
            $title = 'Home';
        } elseif ($title == 'contact') {
            $title = 'Contact';
        }
        return $title = ucwords($title);
    }

}
