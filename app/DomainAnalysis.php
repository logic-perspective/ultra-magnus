<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainAnalysis extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'referrer_id',
        'email_address',
        'domain_score',
        'dmarc_messages',
        'spf_messages',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'dmarc_messages' => 'array',
        'spf_messages' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(Referrer::class);
    }
}
