<?php

namespace App\Models;

use PDO;
use System\Database;
use System\Eloquent\Collection;
use System\View;

class Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected static $connection;
    protected static $table;


    protected static $primaryKey = 'id';
    protected $keyType = 'int';

    protected $with = [];

    protected $withCount = [];

    protected static $perPage = 15;

    public $exists = false;

    public $id;
    public $created_at;
    public $updated_at;

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';


    public function __construct()
    {
        $this->exists = $this->id ? true : false;
    }



    public static function all($columns = ['*']): Collection
    {
        $conn = static::getConnection();
        if (!$conn) {
            throw new \Exception('Connection error');
        }
        $table = static::getTableName();
        $sql = "SELECT";
        foreach ($columns as $key => $column) {
            $sql .= " $column";
            if ($key < count($columns) - 1) {
                $sql .= ",";
            }
        }
        $sql .= " FROM $table";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $result = $stmt->fetchAll() ?? [];
        return  new Collection($result);
    }

    public static function getTableName()
    {
        //nếu tồn tại $table thì trả về luôn
        if (isset(static::$table)) {
            return static::$table;
        }
        //nếu không thì tự suy ra tên bảng theo quy tắc
        $table_name = get_called_class();
        //loại bỏ models\ ở đầu nếu có
        $table_name = str_replace('Models\\', '', $table_name);
        //thêm dấu _ giữa các từ
        $table_name = preg_replace('/(?<!^)[A-Z]/', '_$0', $table_name);
        //kiểm tra quy tắc tiếng anh
        if (substr($table_name, -1) === 'y') {
            $table_name = substr($table_name, 0, -1) . 'ies';
        } else {
            $table_name .= 's';
        }
        //chuyển thành chữ thường
        $table_name = strtolower($table_name);
        return $table_name;
    }




    //getConnection()
    public static function getConnection(): ?PDO
    {
        if (!isset(static::$connection) || static::$connection == null) {
            static::$connection = Database::connection();
        }
        return static::$connection;
    }

    public function getGlobalScopes()
    {
        return [];
    }

    public function getTable()
    {
        return static::$table;
    }

    public function getKeyName()
    {
        return $this->primaryKey;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }
}
