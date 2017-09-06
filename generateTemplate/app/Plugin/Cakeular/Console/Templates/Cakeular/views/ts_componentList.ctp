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
import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { <?= Inflector::pluralize( $pluralHumanName ); ?>Service } from '../../services/<?= $singularVar; ?>.service';
import 'rxjs/Rx';
import { environment } from '../../../environments/environment';
import * as socketIOClient from 'socket.io-client';
import * as sailsIOClient from 'sails.io.js';

@Component({
  selector: 'app-<?= $pluralVar; ?>-list',
  templateUrl: './<?= $pluralVar; ?>-list.component.html',
  styleUrls: ['./<?= $pluralVar; ?>-list.component.css']
})
export class <?= Inflector::pluralize( $pluralHumanName ); ?>ListComponent implements OnInit
{
  io: any;
  <?= $singularVar; ?>: any;

  paging: Object = {
    itemsPerPageOptions: [5, 10, 15, 20, 40, 80, 100]
  };
  page = 1;
  reqParams: Object = {
    limit: '5',
    skip: 0,
    orders: [],
    filters: []
  };
  responseHeaders: Object = {
    start: 0,
    end: 0,
    limit: 0,
    totalItems: 0
  };

  // FiltersNgModels
<?php
foreach ($fields as $field)
{
	echo "	".strtolower( $field )."Filter = '';"."\n";
	echo "	".strtolower( $field )."FilterControl = new FormControl();"."\n";
}
?>

  constructor( private _<?= $pluralVar; ?>Service: <?= Inflector::pluralize( $pluralHumanName ); ?>Service )
  {
    this._<?= $pluralVar; ?>Service.read( null, this.reqParams ).subscribe( response => {
      this.responseHeaders['start'] = Number( response.headers.get('x-info-start') );
      this.responseHeaders['end'] = Number( response.headers.get('x-info-end') );
      this.responseHeaders['limit'] = Number( response.headers.get('x-info-limit') );
      this.responseHeaders['totalItems'] = Number( response.headers.get('x-total-count') );
      this.<?= $pluralVar; ?> = response.json();
    });
    this.io = sailsIOClient(socketIOClient);
    this.io.sails.url = environment.backendUrl;
    this.io.socket.on('connect', () => {
      // Respond to <?= $pluralVar; ?> events.  You can always safely use the
      // global `io.socket` to bind event handlers
      this.io.socket.on('<?= $pluralVar; ?>::update_entry', (message) => {
        console.log( '<?= $pluralVar; ?>::update_entry' );
        console.log( 'message' );
        console.log( message );
      });
      this.io.socket.on('<?= $pluralVar; ?>::new_entry', (message) => {
        console.log('<?= $pluralVar; ?>::new_entry');
        console.log( 'message' );
        console.log( message );
      });
      // subscribe the socket to any events involving the returned <?= $pluralVar; ?>, which
      // will then be handled by the `io.socket.on` code above.
      this.io.socket.get('/<?= $pluralVar; ?>/subscribe', (body, JWR) => {
        console.log('Sails responded with: ', body);
        console.log('with headers: ', JWR.headers);
        console.log('and with status code: ', JWR.statusCode);
      });

    });
  }

  ngOnInit()
  {
    // FilterChanges
<?php
foreach ($fields as $field)
{
	echo "	this.".strtolower( $field )."FilterControl"."\n".
	"		.valueChanges"."\n".
	"		.debounceTime(1000)"."\n".
	"		.subscribe(newValue =>"."\n"."			{"."\n".
	"		this.addFilter('".strtolower( $field )."', newValue);"."\n".
	"	});"."\n";
}
?>
  }

  addFilter(filterName, filterValue)
  {
    let alreadyAdded = false;
    this.reqParams['filters'].forEach( ( filter, index ) =>
    {
      if ( filter.name === filterName && filterValue !== '' )
      {
        alreadyAdded = true;
        filter.value = filterValue;
        this.reloadUsers();
      } else if ( filterValue === '')
      {
        this.reqParams['filters'].splice(index, 1);
        this.reloadData();
      }
    });
    if ( !alreadyAdded && filterValue !== '' )
    {
      this.reqParams['filters'].push({name: filterName, value: filterValue});
      this.reloadUsers();
    }
  }

  ngbPageChange( event: any)
  {
    if ( 0 !== event )
    {
      this.reqParams['skip'] = ( this.reqParams['limit'] * ( event - 1 ));
      this.reloadData();
    }
  }

  reloadData()
  {
    this._<?= $pluralVar; ?>Service.read( null, this.reqParams ).subscribe( response => {
      this.responseHeaders['start'] = Number( response.headers.get('x-info-start') );
      this.responseHeaders['end'] = Number( response.headers.get('x-info-end') );
      this.responseHeaders['limit'] = Number( response.headers.get('x-info-limit') );
      this.responseHeaders['totalItems'] = Number( response.headers.get('x-total-count') );
      this.<?= $pluralVar; ?> = response.json();
    });
  }

}
