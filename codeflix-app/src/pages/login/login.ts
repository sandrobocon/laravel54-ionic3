import {Component} from '@angular/core';
import {IonicPage, MenuController, NavController, NavParams, ToastController} from "ionic-angular"
import 'rxjs/add/operator/toPromise';
import {Auth} from "../../providers/auth";
import {HomePage} from "../home/home";

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

  user = {
    email:'',
    password:''
  };

  // email:string;
  // password:string;
    constructor(
        public navCtrl: NavController,
        public menuCtrl: MenuController,
        public toastCtrl: ToastController,
        public navParams: NavParams,
        private auth: Auth) {
      this.menuCtrl.enable(false);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad Login');
  }

  loginSubmit(){
      this.auth.login(this.user)
          .then(() => {
            this.afterLogin();
          })
          .catch(() => {
            let toast = this.toastCtrl.create({
              message: 'Email e/ou senha inválidos.',
              duration: 3000,
              position: 'top',
              cssClass: 'toast-login-error'
            });

            toast.present();
          });
  }

  loginFacebook(){
    this.auth.loginFacebook()
        .then(() => {
          this.afterLogin();
        })
        .catch(() => {
          let toast = this.toastCtrl.create({
            message: 'Erro ao realizar login no Facebook.',
            duration: 3000,
            position: 'top',
            cssClass: 'toast-login-error'
          });

          toast.present();
        });
  }

  afterLogin(){
    this.menuCtrl.enable(true);
    this.navCtrl.push(HomePage);
  }
}
