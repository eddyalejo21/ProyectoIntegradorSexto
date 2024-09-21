import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IComercio } from '../interfaces/comercios';

@Injectable({
  providedIn: 'root'
})
export class ComerciosService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/back/controllers/comercios.controller.php?op=';

  private http = inject(HttpClient);

  constructor( ) { }

  todos(){
    return this.http.get<IComercio[]>(this.apiurl + 'todos');
  }

  uno(id_comercio: number): Observable<IComercio> {
    const formData = new FormData();
    formData.append('id_comercio', id_comercio.toString());
    return this.http.post<IComercio>(this.apiurl + 'uno', formData);
  }

  insertar(comercio: IComercio): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', comercio.nombre);
    formData.append('direccion', comercio.direccion);
    formData.append('id_estado', comercio.id_estado.toString());
    formData.append('latitud', comercio.latitud.toString());
    formData.append('longitud', comercio.longitud.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(comercio: IComercio): Observable<string> {
    const formData = new FormData();
    formData.append('id_comercio', comercio.id_comercio.toString());
    formData.append('nombre', comercio.nombre);
    formData.append('direccion', comercio.direccion);
    formData.append('id_estado', comercio.id_estado.toString());
    formData.append('latitud', comercio.latitud.toString());
    formData.append('longitud', comercio.longitud.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_comercio: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_comercio', id_comercio.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
