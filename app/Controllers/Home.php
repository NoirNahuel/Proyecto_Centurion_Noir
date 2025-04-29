<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        $data['titulo'] = 'GuitarNCent';
        return view('plantillas/head', $data).view('plantillas/nav').view('principal').view('plantillas/footer');
    }
    public function quieneSomos(){
        $data['titulo'] = 'Quienes Somos';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/quienesSomos').view('plantillas/footer');
    }
    public function acerca_de(){
        $data['titulo'] = 'Nosotros';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/acercaDe').view('plantillas/footer');
    }
    public function contacto(){
        $data['titulo'] = 'Contactanos';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/contacto').view('plantillas/footer');
    }
    
    public function terminos_usos(){
        $data['titulo'] = 'Terminos y Usos';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/terminosUsos').view('plantillas/footer');
    }
    public function comercializacion(){
        $data['titulo'] = 'Comercializacion';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/comercializacion').view('plantillas/footer');
    }
    public function productos() {
        $data['titulo'] = 'Productos - GuitarCN';
        return view('plantillas/head', $data). view('plantillas/nav').view('contenido/productos').view('plantillas/footer');
    }
    
}
