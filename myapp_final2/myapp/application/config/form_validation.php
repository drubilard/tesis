<?php
$config=array(
	'add_paciente'
	=> array(
			array('field'=>'rut', 'label'=>'Rut','rules'=>'required|max_length[10]|min_length[9]'),
			array('field' => 'nombre_paciente', 'label' => 'Nombre','rules' => 'required|is_string|max_length[45]|min_length[3]'),
			array('field' => 'apellido_paciente', 'label' => 'Apellido','rules' => 'required|is_string|max_length[50]|min_length[3]'),
			array('field' => 'sexo', 'label' => 'Sexo','rules' => 'required|max_length[1]|min_length[1]'),
			array('field' => 'fecha_nacimiento_p', 'label' => 'Fecha de nacimiento','rules' => 'required'),
			array('field' => 'correo', 'label' => 'Correo','rules' => 'required|valid_email|max_length[50]')

		),
		'editar_paciente'
	=> array(
			array('field' => 'nombre_paciente', 'label' => 'Nombre','rules' => 'required|is_string|max_length[45]|min_length[3]'),
			array('field' => 'apellido_paciente', 'label' => 'Apellido','rules' => 'required|is_string|max_length[50]|min_length[3]'),
			array('field' => 'sexo', 'label' => 'Sexo','rules' => 'required|max_length[1]|min_length[1]'),
			array('field' => 'fecha_nacimiento_p', 'label' => 'Fecha de nacimiento','rules' => 'required'),
			array('field' => 'correo', 'label' => 'Correo','rules' => 'required|valid_email|max_length[50]')

		),
	'nueva_ficha'
	=> array(
			array('field'=>'fecha','label'=>'Fecha','rules'=>'required'),
			array('field'=>'info', 'label'=>'Información','rules'=>'required')

		),
	'login_formulario'
	=> array(
			array('field' => 'user', 'label' => 'Usuario','rules' => 'required|max_length[50]'),
			array('field' => 'clave', 'label' => 'Clave','rules' => 'required|min_length[6]|max_length[20]')

		),
		'add_nutricionista'
		=> array(
				array('field' => 'rut', 'label' => 'Rut','rules' => 'required|max_length[10]|min_length[9]'),
				array('field' => 'nombre', 'label' => 'Nombre','rules' => 'required|max_length[45]|min_length[3]'),
				array('field' => 'apellido', 'label' => 'Apellido','rules' => 'required|max_length[50]|min_length[3]'),
				array('field' => 'sexo', 'label' => 'Sexo','rules' => 'required|max_length[1]|min_length[1]'),
				array('field' => 'usuario', 'label' => 'Usuario','rules' => 'required|min_length[4]|max_length[20]'),
				array('field' => 'contrasena', 'label' => 'Contraseña','rules' => 'required|min_length[6]'),
				array('field' => 'contrasena_2', 'label' => 'Repetir contraseña','rules' => 'required|min_length[6]|max_length[20]'),
				array('field' => 'correo', 'label' => 'Correo','rules' => 'required|valid_email|max_length[50]')
	
			),
	'add_pat_hab'
	=> array(
			array('field' => 'nombre_pat_hab','label' => 'Nombre', 'rules' =>'required|max_length[45]'),
			array('field' =>'tipo','label' => 'Tipo','rules' =>'required')
		),
	'add_alimento'
	=> array(
			array('field' => 'nombre_alimento','label' => 'Nombre', 'rules' =>'required|min_length[2]|max_length[45]'),
			array('field' =>'tipo','label' => 'Tipo','rules' =>'required|min_length[1]|max_length[11]'),
			array('field' =>'propiedades','label' => 'Propiedades','rules' =>'required|max_length[200]'),
			array('field' =>'aporte','label' => 'Aporte','rules' =>'required|max_length[200]')
		),
	'add_preparacion'
	=> array(
			array('field' => 'nombre','label' => 'Nombre', 'rules' =>'required|min_length[4]|max_length[100]'),
			array('field' =>'tipo','label' => 'Tipo','rules' =>'required')
		),
		'edit_preparacion'
	=> array(
			array('field' => 'nombre_preparacion','label' => 'Nombre', 'rules' =>'required|min_length[4]|max_length[100]'),
			array('field' =>'tipo','label' => 'Tipo','rules' =>'required'),
			array('field' =>'tipo_nutri','label' => 'Tipo','rules' =>'required')
		),
	'add_evaluacion'
	=> array(
			array('field' => 'peso', 'label' => 'Peso','rules' => 'required|max_length[4]')

		),
	'add_porcion'
	=> array(
			array('field' =>'porcion', 'label' =>'Porción','rules' =>'required|max_length[50]')
	)
);

