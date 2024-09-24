import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IPorcentajeGanancia } from '../interfaces/porcentaje-ganancia';

@Injectable({
  providedIn: 'root'
})
export class PorcentajesService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/porcentajeganancia.controller.php?op=';

  private http = inject(HttpClient);

  constructor() { }

  todos() {
    return this.http.get<IPorcentajeGanancia[]>(this.apiurl + 'todos');
  }

  uno(id_porcentajeganancia: number): Observable<IPorcentajeGanancia> {
    const formData = new FormData();
    formData.append('id_porcentajeganancia', id_porcentajeganancia.toString());
    return this.http.post<IPorcentajeGanancia>(this.apiurl + 'uno', formData);
  }

  insertar(porcentajeganancia: IPorcentajeGanancia): Observable<string> {
    const formData = new FormData();
    formData.append('descripcion', porcentajeganancia.descripcion);
    formData.append('valor', porcentajeganancia.valor.toString());
    formData.append('estado', porcentajeganancia.estado.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(porcentajeganancia: IPorcentajeGanancia): Observable<string> {
    const formData = new FormData();
    formData.append('id_porcentajeganancia', porcentajeganancia.id_porcentajeganancia.toString());
    formData.append('descripcion', porcentajeganancia.descripcion);
    formData.append('valor', porcentajeganancia.valor.toString());
    formData.append('estado', porcentajeganancia.estado.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_porcentajeganancia: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_porcentajeganancia', id_porcentajeganancia.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
