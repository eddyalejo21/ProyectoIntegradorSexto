import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { ITipoCliente } from '../interfaces/tipo-cliente';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class TipoClienteService {

  //apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/tipocliente.controller.php?op=';
  apiurl = environment.baseURL + environment.apiURL + 'tipocliente.controller.php?op=';
  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<ITipoCliente[]>(this.apiurl + 'todos');
  }

  uno(id_tipocliente: number): Observable<ITipoCliente> {
    const formData = new FormData();
    formData.append('id_tipocliente', id_tipocliente.toString());
    return this.http.post<ITipoCliente>(this.apiurl + 'uno', formData);
  }

  insertar(tipocliente: ITipoCliente): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', tipocliente.nombre);
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(tipocliente: ITipoCliente): Observable<string> {
    const formData = new FormData();
    formData.append('id_tipocliente', tipocliente.id_tipocliente.toString());
    formData.append('nombre', tipocliente.nombre);
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_tipocliente: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_tipocliente', id_tipocliente.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
