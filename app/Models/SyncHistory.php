<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Market\Models\SyncHistory
 *
 * @property int $id
 * @property int $status
 * @property int|null $amount
 * @property string|null $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SyncHistory whereAmount($value)
 * @method static Builder|SyncHistory whereCreatedAt($value)
 * @method static Builder|SyncHistory whereId($value)
 * @method static Builder|SyncHistory whereMessage($value)
 * @method static Builder|SyncHistory whereStatus($value)
 * @method static Builder|SyncHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    /**
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'status' => $this->status === self::STATUS_SUCCESS ? 'SUCCESS' : 'FAIL',
            'message' => $this->message,
            'amount' => $this->amount,
            'date' => $this->created_at->format(DATE_ATOM),
        ]);
    }
}
