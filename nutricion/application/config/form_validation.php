<?php
$config=array(
	'add_formulario'
	=> array(
			array('field'=>'rut_paciente', 'label'=>'Rut','rules'=>'required|max_length[10]|min_length[9]'),
			array('field' => 'nombre_paciente', 'label' => 'Nombre','rules' => 'required|is_string|max_length[20]|min_length[3]'),
			array('field' => 'apellido_paciente', 'label' => 'Apellido','rules' => 'required|is_string|max_length[20]|min_length[3]'),
			array('field' => 'sexo', 'label' => 'sexo','rules' => 'required'),
			array('field' => 'fecha_nacimiento_p', 'label' => 'Fecha de nacimiento','rules' => 'required')

		),
	'login_formulario'
	=> array(
			array('field' => 'user', 'label' => 'usuario','rules' => 'required|max_length[50]'),
			array('field' => 'clave', 'label' => 'clave','rules' => 'required|min_length[6]|max_length[20]')

		),
		'add_nutricionista'
		=> array(
				array('field' => 'rut_paciente', 'label' => 'Rut','rules' => 'required|max_length[10]|min_length[9]'),
				array('field' => 'nombre', 'label' => 'Nombre','rules' => 'required'),
				array('field' => 'apellido', 'label' => 'Apellido','rules' => 'required'),
				array('field' => 'sexo', 'label' => 'Sexo','rules' => 'required'),
				array('field' => 'usuario', 'label' => 'Usuario','rules' => 'required|max_length[20]'),
				array('field' => 'contrasena', 'label' => 'Contraseña','rules' => 'required|min_length[6]')
	
			),
	'add_vacaciones'
	=> array(
			array('field' => 'usuario_vacacion','label' =>'Persona','rules' => 'required'),
			array('field' => 'fecha_vacaciones_inicio','label' => 'Fecha Desde','rules' => 'required'),
			array('field' => 'fecha_vacaciones_hasta', 'label' => 'Fecha Hasta','rules' =>'required')
		),
	'add_administrativos'
	=> array(
			array('field' => 'usuario_administrativos','label' => 'Persona', 'rules' =>'required'),
			array('field' =>'fecha_administrativo','label' => 'Fecha para día administrativo','rules' =>'required')
		),
	'add_pat_hab'
	=> array(
			array('field' => 'nombre_pat_hab','label' => 'Nombre', 'rules' =>'required'),
			array('field' =>'tipo','label' => 'Tipo','rules' =>'required')
		),
	'add_alimento'
	=> array(
			array('field' => 'nombre_alimento','label' => 'Nombre', 'rules' =>'required'),
			array('field' =>'tipo','label' => 'Tipo','rules' =>'required'),
			array('field' =>'propiedades','label' => 'Propiedades','rules' =>'required'),
			array('field' =>'aporte','label' => 'Aporte','rules' =>'required')
		),
	'add_preparacion'
	=> array(
			array('field' => 'nombre','label' => 'Nombre', 'rules' =>'required'),
			array('field' =>'tipo','label' => 'Tipo','rules' =>'required')
		),
	'add_evaluacion'
	=> array(
			array('field' => 'peso', 'label' => 'peso','rules' => 'required')

		)
);

