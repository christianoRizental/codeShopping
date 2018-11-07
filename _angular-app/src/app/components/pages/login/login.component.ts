import {Component, OnInit} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';

@Component({
  selector: 'login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public credentials = {
      email: 'admin@user.com',
      password: 'secret'
  };
  
  //simbolo [] - o TS reflete alterações no template - Dados ---> template
  //           - a programação irá alterar o template
  
  showMessageError = false;
  
  constructor(private http: HttpClient, private router: Router) { //injeção de dependencia automatica
  }

  ngOnInit() {
    /*
    setTimeout( () => {
        this.email = 'qualquer coisa';
    }, 3000)
    */
  }
  submit(){
      //generics - Java
      this.http.post<any>('http://localhost:8000/api/login', this.credentials)
          .subscribe((data) => {
              //console.log(data);
              const token = data.token;
              window.localStorage.setItem('token',token);
              this.router.navigate(['categories/list']);

          }, () => this.showMessageError = true);
      //enviar uma requisição ajax com as credenciais 
      return false;
  }
}

//Typescript wrapper - superset - ES6 - ES7 ---> será convertido para ES5 - EcmaScript  2014
