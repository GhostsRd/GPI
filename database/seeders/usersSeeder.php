<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création de l'administrateur principal
        User::create([
            'name' => 'Administrateur Principal',
            'email' => 'admin@entreprise.com',
            'phone' => '+33 1 23 45 67 89',
            'poste' => 'Administrateur Système',
            'photo' => null,
            'lieu_travail' => 'Siège Social',
            'password' => Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
            'status' => User::STATUS_ACTIVE,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Création des managers
        $managers = [
            [
                'name' => 'Marie Dubois',
                'email' => 'marie.dubois@entreprise.com',
                'phone' => '+33 1 34 56 78 90',
                'poste' => 'Manager IT',
                'lieu_travail' => 'Paris',
                'password' => Hash::make('manager123'),
            ],
            [
                'name' => 'Pierre Martin',
                'email' => 'pierre.martin@entreprise.com',
                'phone' => '+33 1 45 67 89 01',
                'poste' => 'Manager Support',
                'lieu_travail' => 'Lyon',
                'password' => Hash::make('manager123'),
            ],
        ];

        foreach ($managers as $manager) {
            User::create(array_merge($manager, [
                'photo' => null,
                'role' => User::ROLE_MANAGER,
                'status' => User::STATUS_ACTIVE,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Création des utilisateurs réguliers
        $users = [
            [
                'name' => 'Sophie Lambert',
                'email' => 'sophie.lambert@entreprise.com',
                'phone' => '+33 1 56 78 90 12',
                'poste' => 'Développeuse Web',
                'lieu_travail' => 'Paris',
                'password' => Hash::make('user123'),
            ],
            [
                'name' => 'Thomas Moreau',
                'email' => 'thomas.moreau@entreprise.com',
                'phone' => '+33 1 67 89 01 23',
                'poste' => 'Technicien Support',
                'lieu_travail' => 'Lyon',
                'password' => Hash::make('user123'),
            ],
            [
                'name' => 'Julie Petit',
                'email' => 'julie.petit@entreprise.com',
                'phone' => '+33 1 78 90 12 34',
                'poste' => 'Analyste QA',
                'lieu_travail' => 'Marseille',
                'password' => Hash::make('user123'),
            ],
            [
                'name' => 'David Leroy',
                'email' => 'david.leroy@entreprise.com',
                'phone' => '+33 1 89 01 23 45',
                'poste' => 'Administrateur Réseau',
                'lieu_travail' => 'Paris',
                'password' => Hash::make('user123'),
            ],
        ];

        foreach ($users as $user) {
            User::create(array_merge($user, [
                'photo' => null,
                'role' => User::ROLE_USER,
                'status' => User::STATUS_ACTIVE,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Création d'un utilisateur inactif
        User::create([
            'name' => 'Jean inactive',
            'email' => 'jean.inactif@entreprise.com',
            'phone' => '+33 1 90 12 34 56',
            'poste' => 'Ancien Employé',
            'photo' => null,
            'lieu_travail' => 'Paris',
            'password' => Hash::make('user123'),
            'role' => User::ROLE_USER,
            'status' => User::STATUS_INACTIVE,
            'email_verified_at' => now(),
            'created_at' => now()->subMonths(3),
            'updated_at' => now()->subMonths(2),
        ]);

        // Création d'un utilisateur suspendu
        User::create([
            'name' => 'Alice Suspendue',
            'email' => 'alice.suspendue@entreprise.com',
            'phone' => '+33 1 01 23 45 67',
            'poste' => 'Consultante',
            'photo' => null,
            'lieu_travail' => 'Lyon',
            'password' => Hash::make('user123'),
            'role' => User::ROLE_USER,
            'status' => User::STATUS_SUSPENDED,
            'email_verified_at' => now(),
            'created_at' => now()->subMonths(1),
            'updated_at' => now()->subDays(15),
        ]);

        // Utilisation de Factory pour créer plus d'utilisateurs si nécessaire
        // \App\Models\User::factory(10)->create();

        $this->command->info('Users seeded successfully!');
        $this->command->info('Admin: admin@entreprise.com / admin123');
        $this->command->info('Manager: marie.dubois@entreprise.com / manager123');
        $this->command->info('User: sophie.lambert@entreprise.com / user123');
    }
}