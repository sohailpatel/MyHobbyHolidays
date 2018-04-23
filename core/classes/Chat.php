<?php
class Chat extends Core{
    public function fetchMessages(){ 
        $this -> query("
        SELECT      `group_chat`.`chat`.`message`,
                    `MyHobbyHolidays`.`USER_INFORMATION`.`FirstName`,
                    `MyHobbyHolidays`.`USER_INFORMATION`.`UserID`
        FROM        `group_chat`.`chat`
        JOIN        `MyHobbyHolidays`.`USER_INFORMATION`
        ON          `group_chat`.`chat`.`UserID` = `MyHobbyHolidays`.`USER_INFORMATION`.`UserID`
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