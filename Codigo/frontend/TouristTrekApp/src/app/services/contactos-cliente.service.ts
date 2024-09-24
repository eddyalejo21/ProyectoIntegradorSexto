import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IContactoCliente } from '../interfaces/contactos-cliente';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ContactosClienteService {

  //apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/contactoscliente.controller.php?op=';
  apiurl = environment.baseURL + environment.apiURL + 'contactoscliente.controller.php?op=';
  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IContactoCliente[]>(this.apiurl + 'todos');
  }

  uno(id_contactoscliente: number): Observable<IContactoCliente> {
    const formData = new FormData();
    formData.append('id_contactoscliente', id_contactoscliente.toString());
    return this.http.post<IContactoCliente>(this.apiurl + 'uno', formData);
  }

  insertar(contactocliente: IContactoCliente): Observable<string> {
    const formData = new FormData();
    formData.append('id_mediocontacto', contactocliente.id_mediocontacto.toString());
    formData.append('id_cliente', contactocliente.id_cliente.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(contactocliente: IContactoCliente): Observable<string> {
    const formData = new FormData();
    formData.append('id_contactoscliente', contactocliente.id_contactoscliente.toString());
    formData.append('id_mediocontacto', contactocliente.id_mediocontacto.toString());
    formData.append('id_cliente', contactocliente.id_cliente.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_contactoscliente: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_contactoscliente', id_contactoscliente.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

}
