<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/appointments",
     *     summary="Book an appointment",
     *     tags={"Appointments"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"service_id", "health_professional_id", "date", "time", "time_zone", "email"},
     *             @OA\Property(property="service_id", type="integer", example=1),
     *             @OA\Property(property="health_professional_id", type="integer", example=1),
     *             @OA\Property(property="date", type="string", format="date", example="2023-10-01"),
     *             @OA\Property(property="time", type="string", format="time", example="14:00:00"),
     *             @OA\Property(property="time_zone", type="string", example="UTC"),
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="location_type", type="string", enum={"online", "in-person"}, example="online"),
     *             @OA\Property(property="location_address", type="string", example="123 Main St"),
     *             @OA\Property(property="latitude", type="number", format="float", example=37.7749),
     *             @OA\Property(property="longitude", type="number", format="float", example=-122.4194),
     *             @OA\Property(property="virtual_meeting_link", type="string", format="url", example="https://example.com/meeting"),
     *             @OA\Property(property="language", type="string", example="en"),
     *             @OA\Property(property="contact_phone", type="string", example="+1234567890"),
     *             @OA\Property(property="additional_notes", type="string", example="Please be on time."),
     *             @OA\Property(property="price", type="number", format="float", example=100.00),
     *             @OA\Property(property="currency", type="string", example="USD"),
     *             @OA\Property(property="payment_status", type="string", enum={"unpaid", "paid"}, example="unpaid"),
     *             @OA\Property(property="transaction_id", type="string", example="txn_1234567890"),
     *             @OA\Property(property="follow_up_required", type="boolean", example=true),
     *             @OA\Property(property="follow_up_date", type="string", format="date", example="2023-10-15"),
     *             @OA\Property(property="consent_provided", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Appointment booked successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Appointment booked successfully!"),
     *             @OA\Property(property="appointment", ref="#/components/schemas/Appointment")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     * )
     */
    public function book(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|integer',
            'health_professional_id' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
            'time_zone' => 'required|string',
            'email' => 'required|email',
            'location_type' => 'nullable|string|in:online,in-person',
            'location_address' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'virtual_meeting_link' => 'nullable|url',
            'language' => 'nullable|string|size:2',
            'contact_phone' => 'nullable|string',
            'additional_notes' => 'nullable|string',
            'price' => 'nullable|numeric',
            'currency' => 'nullable|string|size:3',
            'payment_status' => 'nullable|string|in:unpaid,paid',
            'transaction_id' => 'nullable|string',
            'follow_up_required' => 'nullable|boolean',
            'follow_up_date' => 'nullable|date',
            'consent_provided' => 'nullable|boolean',
        ]);

        // Default values if not provided
        $validated['location_type'] = $validated['location_type'] ?? 'online';
        $validated['language'] = $validated['language'] ?? 'en';
        $validated['currency'] = $validated['currency'] ?? 'Euro';
        $validated['status'] = 'pending';
        $validated['payment_status'] = $validated['payment_status'] ?? 'unpaid';

        $appointment = Appointment::create($validated);

        // Generate confirmation token
        $appointment->confirmation_token = Str::random(32);
        $appointment->save();

        // Send confirmation email with token
        Mail::raw('Your appointment has been booked. Use this token to confirm: ' . $appointment->confirmation_token, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Appointment Confirmation');
        });

        return response()->json(['message' => 'Appointment booked successfully!', 'appointment' => $appointment], 201);
    }

    /**
     * @OA\Get(
     *     path="/appointments",
     *     summary="Get all appointments",
     *     tags={"Appointments"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all appointments",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Appointment")
     *         )
     *     )
     * )
     */
    public function show()
    {
        $appointments = Appointment::all();
        return response()->json($appointments, 200);
    }

    /** 
     *   @OA\Get(
     *     path="/appointments/{id}",
     *     summary="Get one appointment",
     *     tags={"Appointments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the appointment",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment found",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Appointment not found.")
     *         )
     *     )
     * )
     */
    public function showById($id)
    {
        $appointment = Appointment::find($id);
        return response()->json($appointment, 200);
    }
}