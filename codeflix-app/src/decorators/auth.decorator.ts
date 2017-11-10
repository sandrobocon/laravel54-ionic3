import {appContainer} from "../app/app.container";
import {Auth as AuthService} from "../providers/auth";

export const Auth = () => {
  return (target: any) => {
    target.prototype.ionViewCanEnter = () => {
      let authService = appContainer().get(AuthService);
      return authService.check().then(isLogged => {
        if(!isLogged){
          //redirect
          return false;
        }
        return true;
      })
    }
    //target cria o ionViewCanEnter
    // redirect login case not loged
    //Auth
  }
};