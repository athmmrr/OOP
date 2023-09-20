<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        // Gunakan pernyataan bersama (prepared statement) untuk menghindari SQL Injection
        $query = "SELECT * FROM tb_login WHERE username = ? AND password = ?";
        $stmt = $this->db->connection->prepare($query);

        // Bind parameter
        $stmt->bind_param("ss", $username, $password);

        // Eksekusi pernyataan
        $stmt->execute();

        // Ambil hasil
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return true; // Login berhasil
        } else {
            return false; // Login gagal
        }
    }
}
?>
