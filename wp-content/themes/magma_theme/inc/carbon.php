<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

	
    Container::make( 'nav_menu', 'Выделеный елемент' )
        ->add_fields( array(
            Field::make( 'select', 'select_el', 'Выделеный елемент' )
			    ->add_options( array(
			        'no' => 'Нет',
			        'yes' => 'Да',
			    ) ),
        ) );

?>