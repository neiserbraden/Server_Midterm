<?php
require_once __DIR__ . "/productClass.php";
require_once __DIR__ . "/JSONhelper.php";

class ProductManager
{
    private static $path = __DIR__ . "/../../data/services.json";
    private static $key  = "services";

    public static function getAll()
    {
        $data = JSONHelper::read(self::$path);
        return $data[self::$key] ?? [];
    }

    public static function get($id)
    {
        $products = self::getAll();
        return $products[$id] ?? null;
    }

    public static function create(Product $product)
    {
        JSONHelper::append(self::$path, self::$key, $product->toArray());
    }

    public static function update($id, Product $product)
    {
        JSONHelper::updateIndex(self::$path, self::$key, $id, $product->toArray());
    }

    public static function delete($id)
    {
        JSONHelper::deleteIndex(self::$path, self::$key, $id);
    }
}