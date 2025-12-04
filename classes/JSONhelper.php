<?php

class JSONhelper
{
    public static function read($path)
    {
        if (!file_exists($path)) return [];

        $json = file_get_contents($path);
        return json_decode($json, true) ?? [];
    }

    public static function write($path, $data)
    {
        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
    }

    public static function append($path, $key, $item)
    {
        $data = self::read($path);

        if (!isset($data[$key])) $data[$key] = [];
        $data[$key][] = $item;

        self::write($path, $data);
    }

    public static function updateIndex($path, $key, $index, $item)
    {
        $data = self::read($path);
        $data[$key][$index] = $item;
        self::write($path, $data);
    }

    public static function deleteIndex($path, $key, $index)
    {
        $data = self::read($path);
        array_splice($data[$key], $index, 1);
        self::write($path, $data);
    }
}
