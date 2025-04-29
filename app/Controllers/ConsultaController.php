<?php

namespace App\Controllers;

class ConsultaController extends BaseController
{
    public function consulta()
    {
        $data['titulo'] = 'Tienda GuitarNCent';
    
        // Verificamos si se hizo un POST (form enviado)
        if ($this->request->getMethod() === 'post') {
            $data['form_enviado'] = true;
        }
    
        return view('plantillas/head', $data)
            . view('plantillas/nav')
            . view('contenido/contacto', $data)
            . view('plantillas/footer');
    }
    
    public function validarmensaje(){
        helper(['form']);
        $validacion = \Config\Services::validation();
        $request=  \Config\Services::request();

        $validacion=[
        'nombre'=>[
            'label'  => 'nombre',
            'rules'  => 'required|min_length[2]|max_length[50]',
            'errors' => [
                'required'   => 'Introduzca su {field}.',
                'min_length' => 'Su {field} debe tener menos de {param} caracteres.',
                'max_length' => 'Su {field} debe tener más de {param} caracteres.'
            ]
        ],
       'email'=>
        [
            'label'  => 'correo electrónico',
            'rules'  => 'required|min_length[4]|max_length[30]|valid_email',
            'errors' => [
                'required'    => 'Introduzca su {field}.',
                'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                'valid_email' => 'El correo electronico ({value}) no es válido.',
                'is_unique'   => 'El correo electronico ({value}) ya está registrado.'
            ]
        ],
        'mensaje'=>[
            'label'  => 'mensaje',
            'rules'  => 'required|min_length[4]|max_length[255]',
            'errors' => [
                'required'   => 'Introduzca {field}.',
                'min_length' => 'La {field} debe tener más de {param} caracteres.',
                'max_length' => 'La {field} debe tener menos de {param} caracteres.'
            ]
        ],
        ];

       /* $validations= $this->validate($rules);*/
     
        if(!$this->validate($validacion)){
            return redirect()->back()->withInput()->with('errors',$this->validator->listErrors());
        }else {
    
    
            // Redirecciona a la página de éxito o muestra un mensaje de confirmación
            return redirect()->to(base_url('/contacto'))->with('mensaje','Su consulta ha sido enviada con exito!');
           
        }
    
            
        

        
    }

}
