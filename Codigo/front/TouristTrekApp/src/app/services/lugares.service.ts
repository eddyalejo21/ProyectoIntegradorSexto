import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { ILugar } from '../interfaces/lugares';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LugaresService {

  
  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/back/controllers/lugares.controller.php?op=';

  private http = inject(HttpClient);

  constructor( ) { }

  todos(){
    return this.http.get<ILugar[]>(this.apiurl + 'todos');
  }

  uno(id_lugar: number): Observable<ILugar> {
    const formData = new FormData();
    formData.append('id_lugar', id_lugar.toString());
    return this.http.post<ILugar>(this.apiurl + 'uno', formData);
  }

  insertar(lugar: ILugar): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', lugar.nombre);
    formData.append('latitud', lugar.latitud.toString());
    formData.append('longitud', lugar.longitud.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(lugar: ILugar): Observable<string> {
    const formData = new FormData();
    formData.append('id_lugar', lugar.id_lugar.toString());
    formData.append('nombre', lugar.nombre);
    formData.append('latitud', lugar.latitud.toString());
    formData.append('longitud', lugar.longitud.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_lugar: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_lugar', id_lugar.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

}
