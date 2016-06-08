<?php

require_once 'models/Model.php';

/**
 * Description of WebContent
 *
 * @author ex4
 */
class WebContent extends Model
{

    private $table_name = "";

    public function insert($webcontent)
    {
        $status = FALSE;
        $sql = "INSERT INTO " . $this->table_name . " (name,description,id_cover) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $webcontent['name'], $webcontent['description'], $webcontent['id_cover']);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    public function update($webcontent)
    {
        $status = false;
        $sql = "UPDATE " . $this->table_name . " SET name = ?,description = ?,id_cover = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssii", $webcontent['name'], $webcontent['description'], $webcontent['id_cover'], $webcontent['id']);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
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
        $content = array();
        $sql = "SELECT id,name,description,id_cover AS cover_id FROM " . $this->table_name . " WHERE id = ?";
        if ($stmt = $this->db->prepare($sql)) {
            $idx = intval($pk);
            $stmt->bind_param("i", $idx);
            $stmt->execute();
            $stmt->bind_result($id, $name, $description, $cover_id);

            while ($stmt->fetch()) {
                $content[] = array("id" => $id, "name" => $name, "description" => $description, "cover_id" => $cover_id);
            }

            $stmt->close();
        }
        return $content;
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
