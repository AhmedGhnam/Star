<?php

namespace App\users\Models;

use App\Connection\DB;

class User {
    public function __construct(
        public ?int $id = null,
        public ?string $userName = null,
        public ?string $passWord = null,
        public ?string $userRole = null,
        public ?int $signStatus = null,
        public ?string $date = null,
        public ?string $profilePicture = null
    ) {}

    public function getId(): int {
        return $this->id;
    }
    public static function getAll(int $limit, int $offset, string $orderBy = 'id', string $direction = 'ASC'): array {
        $allowed = ['id', 'user_name', 'date'];
        if(!in_array($orderBy, $allowed)) {
            $orderBy = 'id';
        }
        $stmt = DB::starCon()->prepare("SELECT id,
                                                    user_name AS userName,
                                                    password AS passWord,
                                                    user_role AS userRole,
                                                    sign_status AS signStatus,
                                                    date FROM users
                                                    ORDER BY $orderBy $direction
                                                    LIMIT :limit OFFSET :offset");
        $stmt->bindvalue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindvalue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class) ?: [];
    }

    public static function countAll(): int {
        $stmt = DB::starCon()->query('SELECT COUNT(*) FROM users');
        $all  = $stmt->fetchColumn();
        return $all; 
    }

    public static function find(?int $id, ?string $name): ?User {
        $stmt = DB::starCon()->prepare('SELECT id,
                                                user_name AS userName,
                                                password AS passWord,
                                                user_role AS userRole,
                                                sign_status AS signStatus,
                                                profile_picture AS profilePicture,
                                                date FROM users WHERE id = ? OR user_name = ?');
        $stmt->execute([$id, $name]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
        return $stmt->fetch() ?: null;
    }

    public function save(): bool {
        if (isset($this->id)) {
            $stmt = DB::starCon()->prepare('UPDATE users SET user_name = ?, profile_picture = ? WHERE id = ?');
            return $stmt->execute([$this->userName, $this->profilePicture, $this->id]);
        } else {
            $stmt = DB::starCon()->prepare('INSERT INTO users (user_name, profile_picture) VALUES (?, ?)');
            $result = $stmt->execute([$this->userName, $this->profilePicture]);
            $this->id = (int)DB::starCon()->lastInsertId();
            return $result;
        }
    }

    public static function search(string $term, int $limit, int $offset, string $orderBy = 'id', string $direction = 'ASC'): ?array {
        $allowed = ['id', 'user_name', 'date'];
        if(!in_array($orderBy, $allowed)) {
            $orderBy = 'id';
        }
        if($term !== "") {
            $stmt = DB::starCon()->prepare("SELECT id,
                                                        user_name AS userName,
                                                        password AS passWord,
                                                        user_role AS userRole,
                                                        sign_status AS signStatus,
                                                    date FROM users
                                                    WHERE user_name LIKE :term
                                                    ORDER BY $orderBy $direction
                                                    LIMIT :limit OFFSET :offset");
            $stmt->bindvalue(':term', '%' . $term . '%', \PDO::PARAM_STR);
            $stmt->bindvalue(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindvalue(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();
            $users = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class) ?: [];
            return $users;
        }

        return [];
    }

    public static function countSearch($term) {
        $stmt = DB::starCon()->prepare('SELECT COUNT(*) FROM users WHERE user_name LIKE :term');
        $stmt->bindvalue(':term', '%' . $term . '%', \PDO::PARAM_STR);
        $stmt->execute();
        $totalUsers = (int) $stmt->fetchColumn();
        return $totalUsers;

    }

    public static function delete(int $id): bool {
        $stmt = DB::starCon()->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public static function count() {
        $stmt = DB::starCon()->query('SELECT COUNT(*) FROM users');
        $totalUsers = $stmt->fetchColumn();
        return $totalUsers;
    }

    public static function latest($num): array {
        $stmt = DB::starCon()->prepare("SELECT id,
                                                user_name AS userName,
                                                user_role AS userRole,
                                                profile_picture AS profilePicture
                                                FROM users
                                                ORDER BY id DESC
                                                LIMIT $num ");
        $stmt->execute();
        $latestUsers = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class);
        return $latestUsers;
    }





}




?>


