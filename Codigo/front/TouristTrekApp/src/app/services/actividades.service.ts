import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IActividad } from '../interfaces/actividades';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ActividadesService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/back/controllers/actividades.controller.php?op=';

  private http = inject(HttpClient);

  constructor() { }

  todos(){
    return this.http.get<IActividad[]>(this.apiurl + 'todos');
  }

  uno(id_actividad: number): Observable<IActividad> {
    const formData = new FormData();
    formData.append('id_actividad', id_actividad.toString());
    return this.http.post<IActividad>(this.apiurl + 'uno', formData);
  }

  insertar(actividad: IActividad): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', actividad.nombre);
    formData.append('id_tipo_actividad', actividad.id_tipo_actividad.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(actividad: IActividad): Observable<string> {
    const formData = new FormData();
    formData.append('id_actividad', actividad.id_actividad.toString());
    formData.append('nombre', actividad.nombre);
    formData.append('id_tipo_actividad', actividad.id_tipo_actividad.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_actividad: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_actividad', id_actividad.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
