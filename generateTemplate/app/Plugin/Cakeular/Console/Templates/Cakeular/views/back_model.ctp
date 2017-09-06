<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
/**
 * <?=Inflector::pluralize($pluralHumanName);?>.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {
  attributes:
  {
<?php
// $this->out( json_encode( $schema ) );
foreach ($fields as $field)
{
    // $this->out( "\n" );
    // $this->out( "field" );
    // $this->out( $field );
    // $this->out( json_encode($schema[$field]) );
    if( $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" )
    {
        if(!($schema[$field]['null']))
        {
            $required = true;
        } else {
            $required = false;
        }
        if( isset($schema[$field]['key']) && 'unique' == $schema[$field]['key'] )
        {
            $unique = true;
        } else {
            $unique = false;
        }
		echo "		".$field .": {"."\n";

		switch ( $schema[$field]["type"] )
		{
			case 'string':
			{
				echo "			type: 'string'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			case 'text':
			{
				echo "			type: 'text'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			case 'integer':
			{
				echo "			type: 'integer'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			case 'float':
			{
				echo "			type: 'float'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			case 'date':
			{
				echo "			type: 'date'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			case 'datetime':
			{
				echo "			type: 'datetime'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			case 'boolean':
			{
				echo "			type: 'boolean'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			case 'decimal':
			{
				echo "			type: 'float'"."\n";
				echo ( ( $required == true ) ? "			, required: true"."\n" : "" );
				echo ( ( $unique == true ) ? "			, unique: true"."\n" : "" );
				break;
			}
			default:
			{
				break;
			}
		}

	echo "		},"."\n";
	}
}
?>
  },
  beforeCreate: function( preObj, cb )
  {
    try{

      cb();

    }catch( err )
    {
      console.log( 'ERROR::<?=Inflector::pluralize($pluralHumanName);?>::beforeCreate:: '+ err );
      cb();
    }
  },
  afterCreate: function( objCreated, cb )
  {
    try{

      sails.sockets.broadcast('<?=strtolower(Inflector::pluralize($pluralHumanName));?>', '<?=strtolower(Inflector::pluralize($pluralHumanName));?>::new_entry', objCreated);

      cb();

    }catch( err )
    {
      console.log( 'ERROR::<?=Inflector::pluralize($pluralHumanName);?>::afterCreate:: '+ err );
      cb();
    }
  },
  beforeUpdate: function( objUpdated, cb)
  {
    try{

      cb();

    }catch( err )
    {
      console.log( 'ERROR::<?=Inflector::pluralize($pluralHumanName);?>::beforeUpdate:: '+ err );
      cb();
    }
  },
  afterUpdate: function( objUpdated, cb)
  {
    try{

      sails.sockets.broadcast('<?=strtolower(Inflector::pluralize($pluralHumanName));?>', '<?=strtolower(Inflector::pluralize($pluralHumanName));?>::update_entry', objUpdated);

      cb();

    }catch( err )
    {
      console.log( 'ERROR::<?=strtolower(Inflector::pluralize($pluralHumanName));?>::afterUpdate:: '+ err );
      cb();
    }
  }
};
