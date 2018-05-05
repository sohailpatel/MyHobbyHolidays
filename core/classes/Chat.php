<?php
class Chat extends Core{
    public function fetchMessages(){ 
        $this -> query("
        SELECT      `group_chat`.`chat`.`message`,
                    `myhobbyholidays`.`USER_INFORMATION`.`FirstName`,
                    `myhobbyholidays`.`USER_INFORMATION`.`UserID`
        FROM        `group_chat`.`chat`
        JOIN        `myhobbyholidays`.`USER_INFORMATION`
        ON          `group_chat`.`chat`.`UserID` = `myhobbyholidays`.`USER_INFORMATION`.`UserID`
        ORDER BY    `group_chat`.`chat`.`timestamp`
        DESC
        ");
        return $this -> rows();
    }
    public function throwMessage($user_id, $message){
        $this->query("
            INSERT INTO `group_chat`.`chat` (`UserID`,`message`,`timestamp`)
            VALUES (".(int)$user_id.",'".$this->db->real_escape_string(htmlentities($message))."',UNIX_TIMESTAMP())
        ");
    }
}
?>