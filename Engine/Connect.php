<?php
namespace App\Connect;

use Config;
use Exception;
use PDO;

class Connect extends Config
{
    private static ?PDO $pdoObject = null;
    private static string $dsn = "mysql:host=%s;dbname=%s;port=%s;charset=%s";

    /**
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        if (self::$pdoObject === null) {
            try {
                $dsn = sprintf(self::$dsn, Config::DB_SERV, Config::DB_NAME, Config::DB_PORT,Config::CHARSET);
                self::$pdoObject = new PDO($dsn, Config::DB_USERNAME, Config::DB_PASSWORD);
                self::$pdoObject->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                self::$pdoObject->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            catch (Exception $e) {
                echo "Une erreur est intervenue ";
                file_put_contents('PDOerrorlog.txt', $e->getMessage() .
                    " " . date('d/m/Y H:i:s') . "\n", FILE_APPEND);;
            }
        }
        return self::$pdoObject;
    }
}