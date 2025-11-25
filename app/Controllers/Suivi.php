<?php

namespace App\Controllers;
use App\Libraries\Gsb_lib;

class Suivi extends BaseController
{
    protected $gsbLib;
    public function __construct()
    {
        // On charge le helper URL et HTML
        helper(['url', 'html']);
        $this->gsbLib = new Gsb_lib();
    }

    public function index() {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $data['titre'] = "Bienvenue sur l'intranet GSB";
        $data['listemenus'] = $this->gsbLib->get_menus(session()->get('role'));

        return view('structures/page_entete')
            . view('structures/messages')
            . view('sommaire', $data)
            . view('structures/contenu_entete', $data)
            . view('en_travaux')
            . view('structures/page_pied');
    }
}