<?php

namespace App\Http\Controllers;

use App\Adresses;
use App\Articles;
use App\Commandes;
use App\Http\Resources\CommandesResource;
use App\Status;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommandesController extends Controller
{
    public function pushPanier(Request $request)
    {

        $commandes = Validator::make(
            $request->all(),
            [
                "order" => "required",
                "adresseFacturation" => 'required',
            ]
        )->validate();
        $prixTotal = [];
        $i = 0;
        foreach ($commandes['order'] as $commande) {
            $i = $i + 1;
            $prixTotal[$i] = $commande['price'] * $commande['quantity'];
        }
        $prixTotal = array_sum($prixTotal);

        $user = $request->user();
        DB::beginTransaction();
        try {
            if ($user) {
                $createCommande = new Commandes;

                $user = $this->addUserToOrder($user, $createCommande);
                $this->addAdresseFacturation($commandes['adresseFacturation'], $createCommande, $user);
                $status = Status::with(['commandes'])->find(1);

                $createCommande->commandeStatus()->associate($status);
                $createCommande->save();
                $this->addProductsToOrder($commandes['order'], $createCommande);
            }

        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        DB::commit();
        // Mail::to($user->email)
        //     ->send(new Contact([
        //     'name' => $user->name,
        //     'order' => $createCommande,
        //     'adresse_livraison' => $commandes['adresseLivraison'],
        //     'adresse_facturation' => $commandes['adresseFacturation'],
        //     'prix_total' => $prixTotal,
        // ]));
        return [new CommandesResource($createCommande), "prix" => $prixTotal];

    }

    public function addAdresseLivraison($adresse, &$commande, $user)
    {
        $adresse = $this->createAdresse($adresse, $user);
        $commande->adresseLivraison()->associate($adresse);
    }
    public function addAdresseFacturation($adresse, &$commande, $user)
    {
        $adresse = $this->createAdresse($adresse, $user);
        $commande->adresseFacturation()->associate($adresse);
    }

    public function createAdresse($_adresse, $user)
    {
        $adresse = new Adresses;
        $adresse->name = $_adresse['name'];
        $adresse->firstname = $_adresse['firstname'];
        $adresse->country = $_adresse['country'];
        $adresse->city = $_adresse['city'];
        $adresse->address = $_adresse['address'];
        $adresse->postal_code = $_adresse['postal_code'];
        $adresse->phone = $_adresse['phone'];
        $adresse->user()->associate($user);
        $adresse->save();
        return $adresse;
    }

    public function addUserToOrder($user, &$commande)
    {

        $loggedUser = User::where('id', '=', $user->id)->first();
        if (!$loggedUser) {
            throw new Exception('Pas connecté');
        }
        $commande->users()->associate($loggedUser);
        return $loggedUser;
    }

    public function addProductsToOrder($basket, &$commande)
    {
        foreach ($basket as $_commande) {
            $quantity = $_commande['quantity'];
            $idProduit = $_commande['id'];
            $produit = Articles::find($idProduit);
            if (!$produit) {
                throw new Exception('Produits incorrects');
            }
            $commande->article()->attach($produit, ['quantity' => $quantity]);
        }
    }
    public function payment(Request $request, $id)
    {
        $paiement = Validator::make(
            $request->input(),
            [
                'id' => 'required',
                'prix' => 'required',
            ]
        )->validate();
        $order = Commandes::find($id);

        try {
            $charge = Stripe::charges()->create([
                'amount' => $paiement["prix"],
                'currency' => 'EUR',
                'source' => $paiement['id'],
                'description' => 'Description',
                'receipt_email' => 'krishna.permal974@gmail.com',
                'metadata' => [
                    'data1' => 'metadata 1',
                    'data2' => 'metadata 2',
                    'data3' => 'metadata 3',
                ],
            ]);
            $status = Status::with(['commandes'])->find(2);
            $order->commandeStatus()->associate($status);
            $order->save();
            return ['payment' => $charge, 'status' => $order];
        } catch (Exception $e) {
            $status = Status::with(['commandes'])->find(1);
            $order->commandeStatus()->associate($status);
            $order->save();
            return ['error' => $e, 'status' => $order];
        }
    }
}
