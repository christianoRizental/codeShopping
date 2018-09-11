import { Component, OnInit } from '@angular/core';
import {HttpClient} from '@angular/common/http';

@Component({
  selector: 'login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public credentials = {
      email: '',
      password: ''
  }
  
  //simbolo [] - o TS reflete alterações no template - Dados ---> template
  //           - a programação irá alterar o template
  
  constructor(private http: HttpClient) { //injeção de dependencia automatica
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
          const token = data.token;
      });
      //enviar uma requisição ajax com as credenciais 
      return false;
  }
}
