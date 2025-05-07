<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        $permissions = [
            // Roles
            'role-list', 'role-create', 'role-edit', 'role-delete',

            // Produits
            'product-list', 'product-create', 'product-edit', 'product-delete',

            // Catégories
            'category-list', 'category-create', 'category-edit', 'category-delete',

            // Stocks
            'stock-list', 'stock-create', 'stock-edit', 'stock-delete',

            // Utilisateurs
            'user-list', 'user-create', 'user-edit', 'user-delete',

            // Fournisseurs
            'fournisseur-list', 'fournisseur-create', 'fournisseur-edit', 'fournisseur-delete',

            // Achats
            'achat-list', 'achat-create', 'achat-edit', 'achat-delete',

            // Clients
            'client-list', 'client-create', 'client-edit', 'client-delete',

            // Commandes reçues
            'commande_recue-list', 'commande_recue-create', 'commande_recue-edit', 'commande_recue-delete',

            // Commandes envoyées
            'commande_envoyee-list', 'commande_envoyee-create', 'commande_envoyee-edit', 'commande_envoyee-delete',

            // Fournir commande
            'fournir_commande-list', 'fournir_commande-create', 'fournir_commande-edit', 'fournir_commande-delete',

            // Ventes
            'vente-list', 'vente-create', 'vente-edit', 'vente-delete',

            // Livraisons
            'livraison-list', 'livraison-create', 'livraison-edit', 'livraison-delete',
        ];
      

        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }
        $user = User::create([

            'name' => 'Hardik Savani', 

            'email' => 'admin@gmail.com',

            'password' => bcrypt('123456')

        ]);

      

        $role = Role::create(['name' => 'Admin']);

       

        $permissions = Permission::pluck('id','id')->all();

     

        $role->syncPermissions($permissions);

       

        $user->assignRole([$role->id]);

    
    }

        

    
    
}