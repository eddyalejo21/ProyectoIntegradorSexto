import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { ITipoActividad } from '../interfaces/tipo-actividad';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TipoActividadService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/tipoactividad.controller.php?op=';

  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<ITipoActividad[]>(this.apiurl + 'todos');
  }

  uno(id_tipoactividad: number): Observable<ITipoActividad> {
    const formData = new FormData();
    formData.append('id_tipoactividad', id_tipoactividad.toString());
    return this.http.post<ITipoActividad>(this.apiurl + 'uno', formData);
  }

  insertar(tipocliente: ITipoActividad): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', tipocliente.nombre);
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(tipocliente: ITipoActividad): Observable<string> {
    const formData = new FormData();
    formData.append('id_tipoactividad', tipocliente.id_tipoactividad.toString());
    formData.append('nombre', tipocliente.nombre);
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_tipoactividad: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_tipoactividad', id_tipoactividad.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
