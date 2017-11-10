import { Injectable } from '@angular/core';
import {Subject} from "rxjs/Subject";
import {Nav} from "ionic-angular";

/*
  Generated class for the Redirector provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class Redirector {

  subject = new Subject();

  config(navCtrl: Nav, link = 'LoginPage'){
    this.subject.subscribe(() => {
      setTimeout(() => {
        navCtrl.setRoot(link);
      });
    })
  }

  redirector(){
    this.subject.next();
  }

}
