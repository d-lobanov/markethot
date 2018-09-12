<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Model;

class SyncHistory extends Model
{
    const STATUS_SUCCESS = 0;
    const STATUS_FAIL = 1;

    /**
     * @var string
     */
    protected $table = 'sync_history';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'id',
        'status',
        'amount',
        'message',
    ];

    /**
     * @param int|null $amount
     * @return bool
     */
    public static function success(?int $amount = null): bool
    {
        $history = new self(['status' => self::STATUS_SUCCESS, 'amount' => $amount]);

        return $history->save();
    }

    /**
     * @param null|string $message
     * @return bool
     */
    public static function fail(?string $message = null): bool
    {
        $history = new self(['status' => self::STATUS_FAIL, 'message' => $message]);

        return $history->save();
    }
}
