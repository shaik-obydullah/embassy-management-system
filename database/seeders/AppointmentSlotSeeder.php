<?php

namespace Database\Seeders;

use App\Models\EmbassyAppointmentSlot;
use App\Models\EmbassyAppointmentStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentSlotSeeder extends Seeder
{
    public function run(): void
    {
        $date = Carbon::now()->startOfWeek();
        $slotsCreated = 0;

        while ($slotsCreated < 10) {
            if ($date->isWeekday()) {
                $times = [
                    ['start' => '09:00', 'end' => '11:00'],
                    ['start' => '14:00', 'end' => '16:00'],
                ];

                foreach ($times as $time) {
                    if ($slotsCreated >= 10) {
                        break;
                    }

                    $slot = EmbassyAppointmentSlot::create([
                        'date' => $date->toDateString(),
                        'start_time' => $time['start'],
                        'end_time' => $time['end'],
                        'max_appointments' => 5,
                        'is_active' => true,
                    ]);

                    EmbassyAppointmentStatus::create([
                        'slot_id' => $slot->id,
                        'current_bookings' => 0,
                        'is_full' => false,
                    ]);

                    $slotsCreated++;
                }
            }

            $date->addDay();
        }
    }
}
