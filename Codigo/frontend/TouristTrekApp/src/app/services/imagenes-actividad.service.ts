import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IImagenesActividad } from '../interfaces/imagenes-actividad';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ImagenesActividadService {

  apiurl = environment.baseURL + environment.apiURL + 'imagenesactividad.controller.php?op=';
  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IImagenesActividad[]>(this.apiurl + 'todos');
  }

  uno(id_imagenesactividad: number): Observable<IImagenesActividad> {
    const formData = new FormData();
    formData.append('id_imagenes_actividad', id_imagenesactividad.toString());
    return this.http.post<IImagenesActividad>(this.apiurl + 'uno', formData);
  }

  insertar(contactocliente: IImagenesActividad): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', contactocliente.nombre);
    formData.append('path', contactocliente.path);
    formData.append('id_actividad', contactocliente.id_actividad.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(contactocliente: IImagenesActividad): Observable<string> {
    const formData = new FormData();
    formData.append('id_imagenesactividad', contactocliente.idimagenes.toString());
    formData.append('nombre', contactocliente.nombre);
    formData.append('path', contactocliente.path);
    formData.append('id_actividad', contactocliente.id_actividad.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_imagenesactividad: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_imagenesactividad', id_imagenesactividad.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  actividad(id_actividad: number): Observable<IImagenesActividad[]> {
    const formData = new FormData();
    formData.append('id_actividad', id_actividad.toString());
    return this.http.post<IImagenesActividad[]>(this.apiurl + 'actividad', formData);
  }
}
