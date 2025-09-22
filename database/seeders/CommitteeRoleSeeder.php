<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommitteeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'President',
            'Vice President',
            'Secretary',
            'Treasurer',
            'Member',
            'Advisor',
            'Coordinator',
            'Chairperson',
            'Co-Chairperson',
            'Public Relations Officer',
            'Event Organizer',
            'Fundraising Chair',
            'Volunteer Coordinator',
            'Communications Officer',
            'Logistics Manager',
            'Membership Chair',
            'Program Director',
            'Social Media Manager',
            'Sponsorship Coordinator',
            'Outreach Coordinator',
            'Technical Support',
            'Historian',
            'Webmaster',
            'Creative Director',
            'Alumni Relations Officer',
            'Diversity and Inclusion Officer',
            'Health and Safety Officer',
            'Sustainability Officer',
            'Training and Development Officer',
            'Research and Development Officer',
            'Quality Assurance Officer',    
            'Compliance Officer',
            'Risk Management Officer',
            'Innovation Officer',
            'Customer Relations Officer',
            'Strategic Planning Officer',
            'Operations Manager',
            'Human Resources Officer',
            'Finance Officer',
            'Legal Advisor',
            'IT Manager',
            'Marketing Manager',
            'Sales Manager',
        ];

        foreach ($roles as $role) {
            DB::table('committee_roles')->updateOrInsert(
                ['name' => $role],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
