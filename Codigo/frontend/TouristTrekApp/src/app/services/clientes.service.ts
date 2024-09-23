import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { ICliente } from '../interfaces/clientes';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ClientesService {

  //apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/clientes.controller.php?op=';
  apiurl = environment.baseURL + environment.apiURL + 'clientes.controller.php?op=';
  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<ICliente[]>(this.apiurl + 'todos');
  }

  uno(id_cliente: number): Observable<ICliente> {
    const formData = new FormData();
    formData.append('id_cliente', id_cliente.toString());
    return this.http.post<ICliente>(this.apiurl + 'uno', formData);
  }

  insertar(cliente: ICliente): Observable<string> {
    const formData = new FormData();
    formData.append('identificacion', cliente.identificacion);
    formData.append('nombre', cliente.nombre);
    formData.append('fecha_nacimiento', cliente.fecha_nacimiento.toString());
    formData.append('genero', cliente.genero);
    formData.append('correo', cliente.correo);
    formData.append('telefono', cliente.telefono);
    formData.append('clave', cliente.clave);
    formData.append('token', cliente.token.toString());
    formData.append('id_tipocliente', cliente.id_tipocliente.toString());
    formData.append('estado', cliente.estado.toString());
    formData.append('id_pais', cliente.id_pais.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(cliente: ICliente): Observable<string> {
    const formData = new FormData();
    formData.append('id_cliente', cliente.id_cliente.toString());
    formData.append('identificacion', cliente.identificacion);
    formData.append('nombre', cliente.nombre);
    formData.append('fecha_nacimiento', cliente.fecha_nacimiento.toString());
    formData.append('genero', cliente.genero);
    formData.append('correo', cliente.correo);
    formData.append('telefono', cliente.telefono);
    formData.append('clave', cliente.clave);
    formData.append('token', cliente.token.toString());
    formData.append('id_tipocliente', cliente.id_tipocliente.toString());
    formData.append('estado', cliente.estado.toString());
    formData.append('id_pais', cliente.id_pais.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_cliente: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_cliente', id_cliente.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

}
