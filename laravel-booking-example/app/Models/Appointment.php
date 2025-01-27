<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @OA\Schema(
 *     schema="Appointment",
 *     type="object",
 *     title="Appointment",
 *     required={"id", "service_id", "health_professional_id", "date", "time", "time_zone", "email", "location_type"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="service_id", type="integer", example=1),
 *     @OA\Property(property="health_professional_id", type="integer", example=1),
 *     @OA\Property(property="date", type="string", format="date", example="2023-10-01"),
 *     @OA\Property(property="time", type="string", format="time", example="14:00:00"),
 *     @OA\Property(property="time_zone", type="string", example="UTC"),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="location_type", type="string", enum={"online", "in-person"}, example="online"),
 *     @OA\Property(property="location_address", type="string", example="123 Main St"),
 *     @OA\Property(property="latitude", type="number", format="float", example=37.7749),
 *     @OA\Property(property="longitude", type="number", format="float", example=-122.4194),
 *     @OA\Property(property="virtual_meeting_link", type="string", example="https://example.com/meeting"),
 *     @OA\Property(property="language", type="string", example="en"),
 *     @OA\Property(property="status", type="string", example="pending"),
 *     @OA\Property(property="confirmation_token", type="string", example="abc123"),
 *     @OA\Property(property="is_rescheduled", type="boolean", example=false),
 *     @OA\Property(property="cancellation_reason", type="string", example="Client request"),
 *     @OA\Property(property="price", type="number", format="float", example=100.00),
 *     @OA\Property(property="currency", type="string", example="USD"),
 *     @OA\Property(property="payment_status", type="string", example="paid"),
 *     @OA\Property(property="transaction_id", type="string", example="txn_123456"),
 *     @OA\Property(property="created_by", type="integer", example=1),
 *     @OA\Property(property="updated_by", type="integer", example=1),
 *     @OA\Property(property="ip_address", type="string", example="192.168.1.1"),
 *     @OA\Property(property="device_info", type="string", example="Mozilla/5.0"),
 *     @OA\Property(property="recurring_id", type="integer", example=1),
 *     @OA\Property(property="follow_up_required", type="boolean", example=false),
 *     @OA\Property(property="follow_up_date", type="string", format="date", example="2023-10-15"),
 *     @OA\Property(property="consent_provided", type="boolean", example=true),
 *     @OA\Property(property="country", type="string", example="USA"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-09-01T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-09-01T12:34:56Z")
 * )
 */
class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'service_id',
        'health_professional_id',
        'date',
        'time',
        'time_zone',
        'email',
        'location_type',
        'location_address',
        'latitude',
        'longitude',
        'virtual_meeting_link',
        'language',
        'status',
        'confirmation_token',
        'is_rescheduled',
        'cancellation_reason',
        'price',
        'currency',
        'payment_status',
        'transaction_id',
        'created_by',
        'updated_by',
        'ip_address',
        'device_info',
        'recurring_id',
        'follow_up_required',
        'follow_up_date',
        'consent_provided',
        'country',
    ];

    protected $hidden = [
        'confirmation_token',
        'transaction_id',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i:s',
        'is_rescheduled' => 'boolean',
        'price' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
        'follow_up_required' => 'boolean',
        'consent_provided' => 'boolean',
        'follow_up_date' => 'date',
    ];


    public function parentAppointment()
    {
        return $this->belongsTo(Appointment::class, 'recurring_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeOnDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('d-m-Y');
    }

    public function isUpcoming()
    {
        return $this->date->isFuture() || ($this->date->isToday() && $this->time->isFuture());
    }

    public function generateConfirmationToken()
    {
        $this->confirmation_token = Str::random(32);
        $this->save();
    }
}
