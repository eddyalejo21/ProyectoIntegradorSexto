import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IActividadComercio } from '../interfaces/actividades-comercio';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ActividadComercioService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/back/controllers/actividadecomercio.controller.php?op=';

  private http = inject(HttpClient);

  constructor() { }

  todos(){
    return this.http.get<IActividadComercio[]>(this.apiurl + 'todos');
  }

  todosJoin(){
    return this.http.get<any[]>(this.apiurl + 'todosJoin');
  }

  uno(id_actividadcomercio: number): Observable<IActividadComercio> {
    const formData = new FormData();
    formData.append('id_actividadcomercio', id_actividadcomercio.toString());
    return this.http.post<IActividadComercio>(this.apiurl + 'uno', formData);
  }

  insertar(actividadComercio: IActividadComercio): Observable<string> {
    const formData = new FormData();
    formData.append('id_actividad', actividadComercio.id_actividad.toString());
    formData.append('id_comercio', actividadComercio.id_comercio.toString());
    formData.append('costo', actividadComercio.costo.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(actividadComercio: IActividadComercio): Observable<string> {
    const formData = new FormData();
    formData.append('id_actividadcomercio', actividadComercio.id_actividadcomercio.toString());
    formData.append('id_actividad', actividadComercio.id_actividad.toString());
    formData.append('id_comercio', actividadComercio.id_comercio.toString());
    formData.append('costo', actividadComercio.costo.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_actividadcomercio: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_actividadcomercio', id_actividadcomercio.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
