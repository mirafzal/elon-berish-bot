<?php

require_once("db_connect.php");

class Announcements
{
    public static function createAnnouncement($chatID, $announcement, $is_media) {
        global $db;

        $announcement = base64_encode($announcement);

        $chatID = $db->real_escape_string($chatID);
        $announcement = $db->real_escape_string($announcement);

        $query = "INSERT INTO `announcements` (`announcement`, `chat_id`, `is_media`) VALUES ('$announcement', $chatID, $is_media)";

        $db->query($query) or die("error(");

        return $db->insert_id;
    }

    public static function getAnnouncements() {
        global $db;

        $announcements = [];

        $result = $db->query("SELECT * FROM `announcements`");

        while ($arr = $result->fetch_assoc()) {
            if (isset($arr['announcement'])) {
                $arr['announcement'] = base64_decode($arr['announcement']);
                $announcements[] = $arr;
            }
        }

        return $announcements;
    }

    public static function setAnnounced($id) {
        global $db;

        $db->query("UPDATE `announcements` SET `is_announced` = '1' WHERE `announcements`.`id` = '$id'") or die("gg((");
    }

    public static function setUnAnnounced($id) {
        global $db;

        $db->query("UPDATE `announcements` SET `is_announced` = '0' WHERE `announcements`.`id` = '$id'") or die("gg((");
    }

    public static function setRejected($id) {
        global $db;

        $db->query("UPDATE `announcements` SET `is_rejected` = '1' WHERE `announcements`.`id` = '$id'") or die("gg((");
    }

    public static function deleteAnnouncement($id) {
        global $db;

        $db->query("DELETE FROM `announcements` WHERE `announcements`.`id` = '$id'") or die("aaaaaa");
    }
}