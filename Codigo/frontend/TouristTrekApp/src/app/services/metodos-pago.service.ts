import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IMetodoPago } from '../interfaces/metodos-pago';

@Injectable({
  providedIn: 'root'
})
export class MetodosPagoService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/metodospago.controller.php?op=';

  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IMetodoPago[]>(this.apiurl + 'todos');
  }

}
