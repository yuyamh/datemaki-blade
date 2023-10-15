<?php

namespace App\Services;

/**
 * Class PostService
 */

 class PostService
 {
    public function convertBytesToMegaBytes($fileSize)
    {
        // バイト数を格納
        $kilobyte = 1024; // 1KB
        $megabyte = $kilobyte * 1000; // 1MB

        // アップロードファイルのサイズをメガバイト、キロバイトへ変換
        if ($megabyte <= $fileSize) {
            // メガバイトへ変換、小数点2桁より下の桁は四捨五入
            return $fileSize = round($fileSize / $megabyte, 2) . 'MB';
        } elseif ($kilobyte <= $fileSize) {
            // キロバイトへ変換、小数点2桁より下の桁は四捨五入
            return $fileSize = round($fileSize / $kilobyte, 2) . 'KB';
        } else {
            return $fileSize . 'B';
        }
    }
 }
