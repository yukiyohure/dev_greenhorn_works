<?php
  namespace App\Services\Classes;

  class Cryptogram {
      /**
       * 簡易的な暗号化
       */
      public static function easyEncryption($data)
      {
        // データをJSON形式に変換
        $json_data = json_encode($data);

        // データをZIP形式で圧縮
        $zipped_data = gzcompress($json_data);

        // データのMAIL_ADDRESSPASSを鍵として使用し、暗号化
        $encrypted_data = openssl_encrypt($zipped_data, 'aes-256-ecb', env('MAIL_ADDRESSPASS'));

        // データを10進数から16進数へ変換
        $hexed_encrypted_data = bin2hex($encrypted_data);

        return $hexed_encrypted_data;
      }

      /**
       * 簡易的な複合
       */
      public static function easyDecryption($hexed_encrypted_data)
      {
        // 16進数から10進数に変換
        $encrypted_data = hex2bin($hexed_encrypted_data);

        // データのMAIL_ADDRESSPASSを鍵として使用し、復号
        $zipped_data = openssl_decrypt($encrypted_data, 'aes-256-ecb', env('MAIL_ADDRESSPASS'));

        // ZIP形式を解凍
        $json_data = gzuncompress($zipped_data);

        // JSON形式から連想配列に変換
        $data = json_decode($json_data);

        return (array) $data;
      }
  }
