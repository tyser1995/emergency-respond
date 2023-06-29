<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncidentType;

class IncidentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'Vehicular Accident'
        ]);

        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'Industrial Accident'
        ]);

        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'Fire Incident'
        ]);

        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'Child Abuse'
        ]);

        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'Injuries'
        ]);

        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'First Aid'
        ]);

        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'Crime Incident'
        ]);

        IncidentType::create([
            'created_by_users_id' => 1,
            'incident_name' => 'Others'
        ]);
    }
}
