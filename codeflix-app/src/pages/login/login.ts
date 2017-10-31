import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams} from "ionic-angular"
import {Http} from "@angular/http";
import 'rxjs/add/operator/toPromise';

/**
 * Generated class for the Login page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {

  email:string;
  password:string;
    constructor(
        public navCtrl: NavController,
        public navParams: NavParams,
        private http:Http) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad Login');
  }

  loginSubmit(){
    this.http.post('http://localhost:8000/api/access_token', {
      email: this.email,
      password: this.password
    })
        .toPromise()
        .then((response) => {
          console.log(response);
        });
  }
}
