<?php

/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 21.10.14
 * Time: 18:01
 */
class DbSessionManager extends DbManager
{
    private $SELECT_SESSION_DATA_BY_ID = "SELECT data FROM sessions WHERE id=? LIMIT 1";

    public function get_session_data_by_id($id)
    {
        if ($id == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->SELECT_SESSION_DATA_BY_ID);
        $pstmt->bind_param("s", $this->connection->escape_string($id));
        $data = null;
        if ($pstmt->execute()) {
            $pstmt->store_result();
            $pstmt->bind_result($data);
            $pstmt->fetch();
        }
        return $data;
    }

    private $REPLACE_SESSION_DATA = "REPLACE INTO sessions (id, set_time, data, session_key) VALUES (?, ?, ?, ?)";

    public function replace_session_data($id, $key, $data)
    {
        if ($id == null || $key == null) {
            throw new InvalidArgumentException;
        }
        $time = time();
        $pstmt = $this->connection->prepare($this->REPLACE_SESSION_DATA);
        $pstmt->bind_param("siss", $this->connection->escape_string($id),
            $this->connection->escape_string($time),
            $this->connection->escape_string($data),
            $this->connection->escape_string($key));
        return $pstmt->execute();
    }

    private $DELETE_SESSION_BY_ID = "DELETE FROM sessions WHERE id = ?";

    public function delete_session($id)
    {
        if ($id == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->DELETE_SESSION_BY_ID);
        $pstmt->bind_param("s", $this->connection->escape_string($id));
        return $pstmt->execute();
    }

    private $DELETE_SESSION_WITH_EXPIRED_TIME = "DELETE FROM sessions WHERE set_time < ?";

    public function delete_session_with_expired_time($max_time)
    {
        if ($max_time == null) {
            throw new InvalidArgumentException;
        }
        $old_time = time() - $max_time;
        $pstmt = $this->connection->prepare($this->DELETE_SESSION_WITH_EXPIRED_TIME);
        $pstmt->bind_param("s", $this->connection->escape_string($old_time));
        return $pstmt->execute();
    }

    private $SELECT_SESSION_KEY_BY_ID = "SELECT session_key FROM sessions WHERE id = ? LIMIT 1";

    public function get_session_key($id)
    {
        if ($id == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->SELECT_SESSION_KEY_BY_ID);
        $pstmt->bind_param("s", $this->connection->escape_string($id));
        $key = null;
        if ($pstmt->execute()) {
            $pstmt->store_result();
            if ($pstmt->num_rows == 1) {
                $pstmt->bind_result($key);
                $pstmt->fetch();
            }
        }
        return $key;

    }
} 