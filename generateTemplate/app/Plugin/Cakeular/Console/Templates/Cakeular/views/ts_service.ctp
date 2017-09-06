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
import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { environment } from '../../environments/environment';
import { UtilService } from './util.service';

@Injectable()
export class <?= $singularHumanName; ?>Service
{

  constructor( private http: Http, private _utilService: UtilService )
  { }

  read( key: any = null, request: any = null )
  {
    let url = `${ environment.backendUrl }/<?= $pluralVar; ?>`;
    if ( null !== key )
    {
      url += `/${ key }`;
      request = null;
    } else {
      url += `?`;
    }

    url = this._utilService.parseTableRequest(url, request);

    // console.log( url );
    return this.http.get( url ).map( response => response );
  }

}
