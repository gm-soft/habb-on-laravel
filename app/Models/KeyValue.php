<?php

namespace App\Models;


use Carbon\Carbon;
use Html;
use LaravelArdent\Ardent\Ardent;

/**
 * Class KeyValue
 * @package App\Models
 *
 * @property int id
 * @property string key - Ключ пары
 * @property string|null value - Значение по ключу
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class KeyValue extends Ardent
{
    protected $table = 'key_values';
    protected $fillable = ['key', 'value'];
    public static $rules = [
        'key' => 'required|between:2,100|unique:key_values',
    ];

    /**
     * Возвращает значение для укороченного представления
     * @param int $length
     * @return string
     */
    public function getValueShortly($length = 30) {

        $value = $this->value;
        if (is_null($value)) return "Нет значения";

        $contentLength = strlen($value);
        if ($length < $contentLength) {
            $returnable = substr($value, 0, $length);
            return $returnable. "...";
        }
        return $this->value;
    }

    /**
     * Кодирует разметку html в пригодную для сохранения в базе
     * @param $content
     */
    public function encodeHtmlContent($content) {
        $this->value = HTML::entities($content);
    }

    /**
     * Декодирует сохраненную кодированную разметку в базе в html-вью
     */
    public function decodeHtmlContent() {
        $this->value = HTML::decode($this->value);
    }


}
