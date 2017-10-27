import { Component } from '@angular/core';

/**
 * Generated class for the Test component.
 *
 * See https://angular.io/api/core/Component for more info on Angular
 * Components.
 */
@Component({
  selector: 'test',
  templateUrl: 'test.html'
})
export class Test {

  text: string;

  constructor() {
    console.log('Hello Test Component');
    this.text = 'Hello World';
  }

}
