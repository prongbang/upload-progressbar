<?php

/**
 * Created by PhpStorm.
 * User: prongbang
 * Date: 6/7/2016
 * Time: 12:03 PM
 */

require_once 'models/Model.php';

class Photos extends Model
{
    private $table_name = "photos";

    public $id;
    public $src;
    public $date;

    public function save()
    {
        $status = FALSE;
        $sql = "INSERT INTO " . $this->table_name . " (src,date) VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $this->src, $this->date);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    public function update()
    {
        $status = false;
        $sql = "UPDATE " . $this->table_name . " SET name = ?,date = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $this->src, $this->date, $this->id);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    public function findAll()
    {
        $data = array();
        $sql = "SELECT * FROM " . $this->table_name;
        $result = $this->db->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function delete($pk)
    {
        $status = false;
        $sql = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $pk);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    public function findByPK($pk)
    {
        $results = array();
        $id = $name = $date = null;
        $sql = "SELECT id,name,date FROM " . $this->table_name . " WHERE id = ?";
        if ($stmt = $this->db->prepare($sql)) {
            $idx = intval($pk);
            $stmt->bind_param("i", $idx);
            $stmt->execute();
            $stmt->bind_result($id, $name, $date);

            while ($stmt->fetch()) {
                $results[] = array("id" => $id, "name" => $name, "date" => $date);
            }

            $stmt->close();
        }
        return $results;
    }

    public function findLastPK()
    {
        $sql = "SELECT id FROM " . $this->table_name . " ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result)['id'];
        }
        return 0;
    }

}