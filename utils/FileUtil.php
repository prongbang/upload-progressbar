<?php

/**
 * Description of FileUtil
 *
 * @author ex4
 */
class FileUtil {

    /**
     * Get Extension
     * @param type $filename
     * @return string
     */
    public static function get_extension($filename) {
        $tmp = explode('.', $filename);
        $f = end($tmp);
        return $f;
    }

    /**
     * Generate Name Photo
     * @param type $index
     * @return string
     */
    public static function generate_name($index) {
        $date = new DateTime();
        $prefix = "0x";
        $center = $date->getTimestamp();
        $suffix = $index;
        return $prefix . $center . $suffix;
    }

    /**
     * Security Check File Extension in Upload
     * @param type $filename
     * @return boolean
     */
    public static function check_file_extension($filename) {
        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'ico');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Reset Array Files
     * @param type $file_post
     * @return type
     */
    public static function reset_array_files(&$file_post) {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    /**
     * Multi Upload File
     * @param type $FILE
     * @param type $target_dir
     * @return array
     */
    public static function uploads($FILE, $target_dir) {
        $status = array();

        if ($FILE) {

            $file_ary = FileUtil::reset_array_files($FILE);

            for ($i = 0; $i < count($file_ary); $i++) {

                $filename = FileUtil::generate_name($i + 1) . "." . FileUtil::get_extension($file_ary[$i]['name']);
                $target_file = $target_dir . basename($filename);

                if (FileUtil::check_file_extension($filename)) {

                    if (move_uploaded_file($file_ary[$i]["tmp_name"], $target_file)) {
                        $status[$i]["src"] = $target_file;
                        $status[$i]["name"] = $file_ary[$i]['name'];
                        $status[$i]["status"] = "Success";
                        $status[$i]["error"] = $file_ary[$i]['error'];
                    } else {
                        $status[$i]["src"] = "";
                        $status[$i]["name"] = $file_ary[$i]['name'];
                        $status[$i]["status"] = "Fail";
                        $status[$i]["error"] = $file_ary[$i]['error'];
                    }
                } else {
                    $status[$i]["src"] = "";
                    $status[$i]["name"] = $file_ary[$i]['name'];
                    $status[$i]["status"] = "Invalid";
                    $status[$i]["error"] = $file_ary[$i]['error'];
                }
            }
        }
        return $status;
    }

    /**
     * Single Upload File
     * @param type $FILE
     * @param array
     * @return array
     */
    public static function upload($FILE, $target_dir) {
        $status = array();

        if (!empty($FILE)) {

            $filename = FileUtil::generate_name(1) . "." . FileUtil::get_extension($FILE['name']);
            $target_file = $target_dir . basename($filename);

            if (FileUtil::check_file_extension($filename)) {

                if (move_uploaded_file($FILE["tmp_name"], $target_file)) {
                    $status["src"] = $target_file;
                    $status["name"] = $FILE['name'];
                    $status["status"] = "Success";
                    $status["error"] = $FILE['error'];
                } else {
                    $status["src"] = "";
                    $status["name"] = $FILE['name'];
                    $status["status"] = "Fail";
                    $status["error"] = $FILE['error'];
                }
            } else {
                $status["src"] = "";
                $status["name"] = $FILE['name'];
                $status["status"] = "Invalid";
                $status["error"] = $FILE['error'];
            }
        }
        return $status;
    }

    public static function delete($filename) {
        $status = false;
        if (file_exists($filename)) {
            unlink($filename);
            $status = true;
        }
        return $status;
    }

}
